<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $table = 'social_links';

    protected $fillable = [
        'platform',
        'icon_class',
        'url',
        'is_active',
        'order_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_by' => 'integer',
    ];

    // Scope for active links
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for ordered links
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_by');
    }
}
