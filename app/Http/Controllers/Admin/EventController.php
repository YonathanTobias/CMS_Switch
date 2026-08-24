<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest('start_date')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|max:3072',
            'registration_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('poster')) {
            $validated['poster'] = '/storage/' . $request->file('poster')->store('events', 'public');
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Agenda kegiatan berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|max:3072',
            'registration_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('poster')) {
            if ($event->poster && !str_starts_with($event->poster, 'http')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $event->poster));
            }
            $validated['poster'] = '/storage/' . $request->file('poster')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Agenda kegiatan berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        if ($event->poster && !str_starts_with($event->poster, 'http')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $event->poster));
        }
        $event->delete();

        return back()->with('success', 'Agenda kegiatan berhasil dihapus.');
    }
}
