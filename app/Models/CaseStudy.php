<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseStudy extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $table = 'cases';

    protected $fillable = [
        'category_id',
        'slug',
        'title',
        'client_name',
        'location',
        'summary',
        'content',
        'challenge',
        'solution',
        'results',
        'featured_image',
        'gallery',
        'project_date',
        'is_featured',
        'is_active',
        'sort_order',
        'view_count',
        'meta_title',
        'meta_description',
    ];

    public $translatable = [
        'title',
        'client_name',
        'location',
        'summary',
        'content',
        'challenge',
        'solution',
        'results',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'view_count' => 'integer',
        'project_date' => 'date',
        'gallery' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getSeoScoreAttribute(): int
    {
        $score = 0;
        
        $title = $this->getTranslation('title', app()->getLocale()) ?? '';
        if (mb_strlen($title) >= 10 && mb_strlen($title) <= 70) $score += 25;
        
        $content = $this->getTranslation('content', app()->getLocale()) ?? '';
        if (mb_strlen(strip_tags($content)) >= 300) $score += 35;
        elseif (mb_strlen(strip_tags($content)) > 0) $score += 15;
        
        if ($this->featured_image) $score += 15;
        if (!empty($this->gallery)) $score += 10;
        if ($this->getTranslation('meta_title', app()->getLocale())) $score += 10;
        if ($this->getTranslation('meta_description', app()->getLocale())) $score += 5;
        
        return min(100, $score);
    }
}
