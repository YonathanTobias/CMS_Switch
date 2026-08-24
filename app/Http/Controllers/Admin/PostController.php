<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category', 'user');

        if ($request->has('type') && in_array($request->type, ['berita', 'pengumuman'])) {
            $query->where('type', $request->type);
        }

        if ($request->has('q') && $request->q) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $posts = $query->latest('published_at')->paginate(15)->withQueryString();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('type', 'post')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'required|in:berita,pengumuman',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:3072',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $request->filled('published_at') ? $request->published_at : now();

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = '/storage/' . $request->file('thumbnail')->store('posts', 'public');
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Konten berita/pengumuman berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        $categories = Category::where('type', 'post')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'required|in:berita,pengumuman',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:3072',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $request->filled('published_at') ? $request->published_at : $post->published_at;

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail && !str_starts_with($post->thumbnail, 'http')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $post->thumbnail));
            }
            $validated['thumbnail'] = '/storage/' . $request->file('thumbnail')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        if ($post->thumbnail && !str_starts_with($post->thumbnail, 'http')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $post->thumbnail));
        }
        $post->delete();

        return back()->with('success', 'Konten berhasil dihapus.');
    }
}
