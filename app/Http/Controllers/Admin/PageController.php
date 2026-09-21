<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('order_index', 'asc')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $layoutType = $request->input('layout_type', 'standard');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'layout_type' => 'required|in:standard,blocks',
            'content' => $layoutType === 'standard' ? 'required|string' : 'nullable|string',
            'blocks_json' => 'nullable|string',
            'banner_image' => 'nullable|image|max:5120',
            'is_published' => 'boolean',
            'order_index' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');
        $validated['order_index'] = $request->input('order_index', 0);
        $validated['content'] = $validated['content'] ?? '';

        if ($layoutType === 'blocks' && !empty($request->input('blocks_json'))) {
            $decoded = json_decode($request->input('blocks_json'), true);
            $validated['blocks_data'] = is_array($decoded) ? $decoded : [];
        } else {
            $validated['blocks_data'] = null;
        }

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = \App\Services\ImageService::uploadAndOptimize($request->file('banner_image'), 'pages', 1920, 85);
        }

        Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman kustom berhasil dibuat.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $layoutType = $request->input('layout_type', 'standard');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'layout_type' => 'required|in:standard,blocks',
            'content' => $layoutType === 'standard' ? 'required|string' : 'nullable|string',
            'blocks_json' => 'nullable|string',
            'banner_image' => 'nullable|image|max:5120',
            'is_published' => 'boolean',
            'order_index' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');
        $validated['order_index'] = $request->input('order_index', 0);
        $validated['content'] = $validated['content'] ?? '';

        if ($layoutType === 'blocks' && !empty($request->input('blocks_json'))) {
            $decoded = json_decode($request->input('blocks_json'), true);
            $validated['blocks_data'] = is_array($decoded) ? $decoded : [];
        } else {
            $validated['blocks_data'] = null;
        }

        if ($request->hasFile('banner_image')) {
            if ($page->banner_image && !str_starts_with($page->banner_image, 'http')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $page->banner_image));
            }
            $validated['banner_image'] = \App\Services\ImageService::uploadAndOptimize($request->file('banner_image'), 'pages', 1920, 85);
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman kustom berhasil diperbarui.');
    }

    public function uploadAsset(Request $request)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'image|max:5120'
        ]);

        $urls = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $url = \App\Services\ImageService::uploadAndOptimize($file, 'pages/assets', 1920, 85);
                $urls[] = $url;
            }
        }

        return response()->json([
            'data' => $urls
        ]);
    }

    public function builder(Page $page)
    {
        return view('admin.pages.builder', compact('page'));
    }

    public function saveBuilder(Request $request, Page $page)
    {
        $html = $request->input('html', '');
        $css = $request->input('css', '');
        
        $content = '';
        if (!empty(trim($css))) {
            $content .= '<style>' . $css . '</style>' . "\n";
        }
        $content .= $html;

        $gjsProject = [
            'components' => json_decode($request->input('components', '[]'), true),
            'styles' => json_decode($request->input('styles', '[]'), true),
            'html' => $html,
            'css' => $css,
        ];

        $page->update([
            'layout_type' => 'grapesjs',
            'content' => $content,
            'blocks_data' => $gjsProject,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Halaman visual builder berhasil disimpan!'
        ]);
    }

    public function destroy(Page $page)
    {
        if ($page->banner_image && !str_starts_with($page->banner_image, 'http')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $page->banner_image));
        }
        $page->delete();

        return back()->with('success', 'Halaman kustom berhasil dihapus.');
    }
}

