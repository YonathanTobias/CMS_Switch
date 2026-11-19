<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order_index', 'asc')->get();
        $featureEnabled = get_setting('enable_services', '1') !== '0';
        return view('admin.services.index', compact('services', 'featureEnabled'));
    }

    /**
     * Toggle global "Layanan Divisi" feature ON / OFF
     */
    public function toggleFeature(Request $request)
    {
        $current = get_setting('enable_services', '1') !== '0';
        $newValue = $request->has('enable_services')
            ? ($request->input('enable_services') == '1' ? '1' : '0')
            : ($current ? '0' : '1');

        Setting::set('enable_services', $newValue);
        Setting::clearCache();

        $statusLabel = $newValue === '1'
            ? 'AKTIF (Ditampilkan di Website Publik)'
            : 'NONAKTIF (Disembunyikan dari Website Publik)';

        return back()->with('success', 'Fitur Layanan Divisi berhasil diubah menjadi: ' . $statusLabel);
    }

    /**
     * Toggle individual service item active status ON / OFF
     */
    public function toggleStatus(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);
        return back()->with('success', 'Status layanan "' . $service->title . '" berhasil diperbarui.');
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'summary' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'procedure' => 'nullable|string',
            'download_form_link' => 'nullable|string|max:255',
            'order_index' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $request->input('order_index', 0);

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan divisi berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'summary' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'procedure' => 'nullable|string',
            'download_form_link' => 'nullable|string|max:255',
            'order_index' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $request->input('order_index', 0);

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan divisi berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Layanan berhasil dihapus.');
    }
}
