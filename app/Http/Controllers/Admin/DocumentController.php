<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('category')->latest()->paginate(15);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $categories = Category::where('type', 'document')->get();
        return view('admin.documents.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'document_file' => 'required|file|max:15360', // max 15MB
            'description' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        $file = $request->file('document_file');
        $path = $file->store('documents', 'public');

        $validated['file_path'] = $path;
        $validated['file_type'] = strtoupper($file->getClientOriginalExtension());
        $validated['file_size'] = format_file_size($file->getSize());
        $validated['is_published'] = $request->has('is_published');

        Document::create($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diunggah.');
    }

    public function edit(Document $document)
    {
        $categories = Category::where('type', 'document')->get();
        return view('admin.documents.edit', compact('document', 'categories'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'document_file' => 'nullable|file|max:15360',
            'description' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('document_file')) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $file = $request->file('document_file');
            $path = $file->store('documents', 'public');
            $validated['file_path'] = $path;
            $validated['file_type'] = strtoupper($file->getClientOriginalExtension());
            $validated['file_size'] = format_file_size($file->getSize());
        }

        $document->update($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Document $document)
    {
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }
        $document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
