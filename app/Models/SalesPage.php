<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SalesPage extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'custom_message',
        'banner_image',
        'featured_products',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'featured_products' => 'array',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the user for this sales page
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for active sales pages
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Generate slug from title
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($salesPage) {
            if (empty($salesPage->slug)) {
                $salesPage->slug = Str::slug($salesPage->title);
            }
        });

        static::updating(function ($salesPage) {
            if ($salesPage->isDirty('title') && empty($salesPage->slug)) {
                $salesPage->slug = Str::slug($salesPage->title);
            }
        });
    }
}
