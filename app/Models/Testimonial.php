<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Testimonial extends Model
{
    protected $fillable = [
        'customer_name',
        'title',
        'customer_location',
        'customer_occupation',
        'customer_image',
        'content',
        'rating',
        'video_url',
        'video_file',
        'is_featured',
        'is_active',
        'sort_order',
        'author',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'integer',
    ];

    /**
     * Scope for active testimonials
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured testimonials
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for ordered testimonials
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get YouTube video ID from URL
     */
    public function getYoutubeVideoIdAttribute()
    {
        if (!$this->video_url) {
            return null;
        }

        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->video_url, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }

    /**
     * Get YouTube thumbnail URL
     */
    public function getYoutubeThumbnailAttribute()
    {
        $videoId = $this->youtube_video_id;

        return $videoId ? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg" : null;
    }

    /**
     * Get the user that owns the testimonial.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Backwards-compatible accessor for legacy `is_approved` column
     */
    public function getIsApprovedAttribute()
    {
        // If the DB actually has an is_approved column, prefer its value (safely checking attributes)
        if (Schema::hasColumn($this->getTable(), 'is_approved')) {
            if (array_key_exists('is_approved', $this->attributes)) {
                return (bool) $this->attributes['is_approved'];
            }
            // fallback to is_active if attribute not present
            return (bool) ($this->attributes['is_active'] ?? $this->is_active ?? false);
        }

        // No column in DB; fall back to is_active
        return (bool) ($this->attributes['is_active'] ?? $this->is_active ?? false);
    }

    /**
     * Scope for approved testimonials (legacy support for `is_approved`)
     */
    public function scopeApproved($query)
    {
        // Avoid using $this inside a query scope; instantiate a model to get table name
        $table = (new static)->getTable();

        if (Schema::hasColumn($table, 'is_approved')) {
            return $query->where('is_approved', true);
        }

        return $query->where('is_active', true);
    }
}
