<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title_degree',
        'identifier',
        'position',
        'photo',
        'bio',
        'email',
        'phone',
        'order_index',
    ];

    protected $casts = [
        'order_index' => 'integer',
    ];

    public function getFullTitleAttribute(): string
    {
        return $this->name . ($this->title_degree ? ', ' . $this->title_degree : '');
    }
}
