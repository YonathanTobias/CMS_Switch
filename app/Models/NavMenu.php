<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'url',
        'target',
        'order_index',
        'is_active',
        'parent_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_index' => 'integer',
    ];

    /**
     * Scope active menus
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope ordered
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Parent menu item
     */
    public function parent()
    {
        return $this->belongsTo(NavMenu::class, 'parent_id');
    }

    /**
     * Submenu items
     */
    public function children()
    {
        return $this->hasMany(NavMenu::class, 'parent_id')->ordered();
    }

    /**
     * Get default standard menu items
     */
    public static function getDefaultMenus(): array
    {
        return [
            ['label' => 'Beranda', 'url' => '/', 'target' => '_self', 'order_index' => 1, 'is_active' => true],
            ['label' => 'Tentang Kami', 'url' => '/profil', 'target' => '_self', 'order_index' => 2, 'is_active' => true],
            ['label' => 'Layanan', 'url' => '/layanan', 'target' => '_self', 'order_index' => 3, 'is_active' => true],
            ['label' => 'Berita & Pengumuman', 'url' => '/berita', 'target' => '_self', 'order_index' => 4, 'is_active' => true],
            ['label' => 'Agenda Kegiatan', 'url' => '/agenda', 'target' => '_self', 'order_index' => 5, 'is_active' => true],
            ['label' => 'Dokumen & Unduhan', 'url' => '/unduhan', 'target' => '_self', 'order_index' => 6, 'is_active' => true],
            ['label' => 'Galeri Foto', 'url' => '/galeri', 'target' => '_self', 'order_index' => 7, 'is_active' => true],
            ['label' => 'Kontak', 'url' => '/kontak', 'target' => '_self', 'order_index' => 8, 'is_active' => true],
        ];
    }

    /**
     * Reset table to default menus
     */
    public static function resetToDefaults(): void
    {
        static::truncate();

        foreach (static::getDefaultMenus() as $menu) {
            static::create($menu);
        }
    }
}
