<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'layout_type',
        'content',
        'blocks_data',
        'banner_image',
        'is_published',
        'order_index',
    ];

    protected $casts = [
        'blocks_data' => 'array',
        'is_published' => 'boolean',
        'order_index' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('order_index', 'asc');
    }
}
