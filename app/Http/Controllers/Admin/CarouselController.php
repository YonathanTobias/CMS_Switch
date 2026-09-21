<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderBy('order_index', 'asc')->get();
        return view('admin.carousels.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'show_overlay' => 'nullable|boolean',
            'image' => 'required|image|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order_index' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['show_overlay'] = $request->has('show_overlay') 
            ? $request->boolean('show_overlay') 
            : (!empty($request->input('title')) || !empty($request->input('subtitle')));
            
        $validated['image_path'] = \App\Services\ImageService::uploadAndOptimize($request->file('image'), 'carousels', 1920, 85);
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $request->input('order_index', 0);

        Carousel::create($validated);

        return redirect()->route('admin.carousels.index')->with('success', 'Slide banner carousel berhasil ditambahkan.');
    }

    public function edit(Carousel $carousel)
    {
        return view('admin.carousels.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'show_overlay' => 'nullable|boolean',
            'image' => 'nullable|image|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order_index' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['show_overlay'] = $request->has('show_overlay') 
            ? $request->boolean('show_overlay') 
            : (!empty($request->input('title')) || !empty($request->input('subtitle')));
            
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $request->input('order_index', 0);

        if ($request->hasFile('image')) {
            if ($carousel->image_path && !str_starts_with($carousel->image_path, 'http')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $carousel->image_path));
            }
            $validated['image_path'] = \App\Services\ImageService::uploadAndOptimize($request->file('image'), 'carousels', 1920, 85);
        }

        $carousel->update($validated);

        return redirect()->route('admin.carousels.index')->with('success', 'Slide banner carousel berhasil diperbarui.');
    }

    public function destroy(Carousel $carousel)
    {
        if ($carousel->image_path && !str_starts_with($carousel->image_path, 'http')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $carousel->image_path));
        }
        $carousel->delete();

        return back()->with('success', 'Slide banner carousel berhasil dihapus.');
    }
}
