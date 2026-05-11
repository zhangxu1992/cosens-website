<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'key',
        'slug',
        'title',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'template',
        'is_active',
        'sort_order',
    ];

    public $translatable = [
        'title',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }

    public function getSeoScoreAttribute(): int
    {
        $score = 0;
        
        $title = $this->getTranslation('title', app()->getLocale()) ?? '';
        if (mb_strlen($title) >= 10 && mb_strlen($title) <= 70) $score += 25;
        
        $content = $this->getTranslation('content', app()->getLocale()) ?? '';
        if (mb_strlen(strip_tags($content)) >= 300) $score += 45;
        elseif (mb_strlen(strip_tags($content)) > 0) $score += 20;
        
        if ($this->getTranslation('meta_title', app()->getLocale())) $score += 15;
        if ($this->getTranslation('meta_description', app()->getLocale())) $score += 15;
        
        return min(100, $score);
    }
}
