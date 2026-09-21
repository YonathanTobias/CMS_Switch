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
        $sourceType = $request->input('source_type', 'file');

        $rules = [
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'is_published' => 'boolean',
        ];

        if ($sourceType === 'gdrive') {
            $rules['gdrive_url'] = 'required|url|max:1000';
            $rules['custom_file_type'] = 'nullable|string|max:20';
            $rules['custom_file_size'] = 'nullable|string|max:50';
        } else {
            $rules['document_file'] = 'required|file|max:25600'; // max 25MB
        }

        $validated = $request->validate($rules);
        $validated['is_published'] = $request->has('is_published');

        if ($sourceType === 'gdrive') {
            $validated['file_path'] = $request->input('gdrive_url');
            $fileType = strtoupper($request->input('custom_file_type', 'GDRIVE'));
            $validated['file_type'] = $fileType ?: 'GDRIVE';
            $validated['file_size'] = $request->input('custom_file_size') ?: 'Google Drive';
        } else {
            $file = $request->file('document_file');
            $path = $file->store('documents', 'public');
            $validated['file_path'] = $path;
            $validated['file_type'] = strtoupper($file->getClientOriginalExtension());
            $validated['file_size'] = format_file_size($file->getSize());
        }

        Document::create($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(Document $document)
    {
        $categories = Category::where('type', 'document')->get();
        return view('admin.documents.edit', compact('document', 'categories'));
    }

    public function update(Request $request, Document $document)
    {
        $sourceType = $request->input('source_type', 'file');

        $rules = [
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'is_published' => 'boolean',
        ];

        if ($sourceType === 'gdrive') {
            $rules['gdrive_url'] = 'required|url|max:1000';
            $rules['custom_file_type'] = 'nullable|string|max:20';
            $rules['custom_file_size'] = 'nullable|string|max:50';
        } else {
            $rules['document_file'] = 'nullable|file|max:25600';
        }

        $validated = $request->validate($rules);
        $validated['is_published'] = $request->has('is_published');

        if ($sourceType === 'gdrive') {
            if ($document->file_path && !str_starts_with($document->file_path, 'http') && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $validated['file_path'] = $request->input('gdrive_url');
            $fileType = strtoupper($request->input('custom_file_type', 'GDRIVE'));
            $validated['file_type'] = $fileType ?: 'GDRIVE';
            $validated['file_size'] = $request->input('custom_file_size') ?: 'Google Drive';
        } else {
            if ($request->hasFile('document_file')) {
                if ($document->file_path && !str_starts_with($document->file_path, 'http') && Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }
                $file = $request->file('document_file');
                $path = $file->store('documents', 'public');
                $validated['file_path'] = $path;
                $validated['file_type'] = strtoupper($file->getClientOriginalExtension());
                $validated['file_size'] = format_file_size($file->getSize());
            }
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
