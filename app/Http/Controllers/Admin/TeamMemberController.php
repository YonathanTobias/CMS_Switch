<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('order_index', 'asc')->get();
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'title_degree' => 'nullable|string|max:100',
            'identifier' => 'nullable|string|max:100',
            'position' => 'required|string|max:150',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:30',
            'order_index' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = '/storage/' . $request->file('photo')->store('team', 'public');
        }

        $validated['order_index'] = $request->input('order_index', 0);
        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Anggota/Pengurus berhasil ditambahkan.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'title_degree' => 'nullable|string|max:100',
            'identifier' => 'nullable|string|max:100',
            'position' => 'required|string|max:150',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:30',
            'order_index' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            if ($team->photo && !str_starts_with($team->photo, 'http')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $team->photo));
            }
            $validated['photo'] = '/storage/' . $request->file('photo')->store('team', 'public');
        }

        $validated['order_index'] = $request->input('order_index', 0);
        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Data anggota/pengurus berhasil diperbarui.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo && !str_starts_with($team->photo, 'http')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $team->photo));
        }
        $team->delete();

        return back()->with('success', 'Anggota/Pengurus berhasil dihapus.');
    }
}
