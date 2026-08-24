<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(18);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'required|string|max:100',
            'image' => 'required|image|max:5120',
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('gallery', 'public');
        $validated['image_path'] = '/storage/' . $path;

        Gallery::create($validated);

        return back()->with('success', 'Foto dokumentasi kegiatan berhasil diunggah.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path && !str_starts_with($gallery->image_path, 'http')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $gallery->image_path));
        }
        $gallery->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }
}
