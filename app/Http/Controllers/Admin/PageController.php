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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'banner_image' => 'nullable|image|max:3072',
            'is_published' => 'boolean',
            'order_index' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');
        $validated['order_index'] = $request->input('order_index', 0);

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = '/storage/' . $request->file('banner_image')->store('pages', 'public');
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'banner_image' => 'nullable|image|max:3072',
            'is_published' => 'boolean',
            'order_index' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');
        $validated['order_index'] = $request->input('order_index', 0);

        if ($request->hasFile('banner_image')) {
            if ($page->banner_image && !str_starts_with($page->banner_image, 'http')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $page->banner_image));
            }
            $validated['banner_image'] = '/storage/' . $request->file('banner_image')->store('pages', 'public');
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman kustom berhasil diperbarui.');
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
