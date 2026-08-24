<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavMenu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the navigation menus.
     */
    public function index()
    {
        $menus = NavMenu::with('parent')->ordered()->get();
        $parentMenus = NavMenu::whereNull('parent_id')->ordered()->get();
        $pages = Page::published()->get();

        $predefinedRoutes = [
            ['label' => 'Beranda', 'url' => '/'],
            ['label' => 'Tentang Kami', 'url' => '/profil'],
            ['label' => 'Layanan Divisi', 'url' => '/layanan'],
            ['label' => 'Berita & Pengumuman', 'url' => '/berita'],
            ['label' => 'Agenda Kegiatan', 'url' => '/agenda'],
            ['label' => 'Dokumen & Unduhan', 'url' => '/unduhan'],
            ['label' => 'Galeri Foto', 'url' => '/galeri'],
            ['label' => 'Kontak & Lokasi', 'url' => '/kontak'],
        ];

        return view('admin.menus.index', compact('menus', 'parentMenus', 'pages', 'predefinedRoutes'));
    }

    /**
     * Store a newly created menu item in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'target' => 'required|in:_self,_blank',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:nav_menus,id',
        ]);

        $validated['is_active'] = $request->has('is_active') ? (bool)$request->is_active : true;
        
        if (!isset($validated['order_index']) || $validated['order_index'] === null) {
            $maxOrder = NavMenu::max('order_index') ?? 0;
            $validated['order_index'] = $maxOrder + 1;
        }

        NavMenu::create($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Item menu navigasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified menu item.
     */
    public function edit($id)
    {
        $menu = NavMenu::findOrFail($id);
        $parentMenus = NavMenu::whereNull('parent_id')->where('id', '!=', $menu->id)->ordered()->get();
        $pages = Page::published()->get();

        $predefinedRoutes = [
            ['label' => 'Beranda', 'url' => '/'],
            ['label' => 'Tentang Kami', 'url' => '/profil'],
            ['label' => 'Layanan Divisi', 'url' => '/layanan'],
            ['label' => 'Berita & Pengumuman', 'url' => '/berita'],
            ['label' => 'Agenda Kegiatan', 'url' => '/agenda'],
            ['label' => 'Dokumen & Unduhan', 'url' => '/unduhan'],
            ['label' => 'Galeri Foto', 'url' => '/galeri'],
            ['label' => 'Kontak & Lokasi', 'url' => '/kontak'],
        ];

        return view('admin.menus.edit', compact('menu', 'parentMenus', 'pages', 'predefinedRoutes'));
    }

    /**
     * Update the specified menu item in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = NavMenu::findOrFail($id);

        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'target' => 'required|in:_self,_blank',
            'order_index' => 'required|integer',
            'is_active' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:nav_menus,id',
        ]);

        $validated['is_active'] = $request->has('is_active') ? (bool)$request->is_active : false;

        $menu->update($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Item menu navigasi berhasil diperbarui.');
    }

    /**
     * Remove the specified menu item from storage.
     */
    public function destroy($id)
    {
        $menu = NavMenu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Item menu navigasi berhasil dihapus.');
    }

    /**
     * Reset menu items to default list.
     */
    public function resetDefaults()
    {
        NavMenu::resetToDefaults();

        return redirect()->route('admin.menus.index')->with('success', 'Susunan menu navigasi berhasil di-reset ke pengaturan standar bawaan.');
    }
}
