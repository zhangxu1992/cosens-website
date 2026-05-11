<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, Searchable;

    protected $fillable = [
        'category_id',
        'author_id',
        'slug',
        'title',
        'excerpt',
        'content',
        'featured_image',
        'type',
        'is_published',
        'published_at',
        'view_count',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public $translatable = [
        'title',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'view_count' => 'integer',
    ];

    // 分类
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // 作者
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // 已发布
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    // 公司新闻
    public function scopeCompany($query)
    {
        return $query->where('type', 'company');
    }

    // 行业新闻
    public function scopeIndustry($query)
    {
        return $query->where('type', 'industry');
    }

    // 获取摘要（如果没有设置则自动生成）
    public function getExcerptOrGenerateAttribute(): string
    {
        $excerpt = $this->getTranslation('excerpt', app()->getLocale());
        if (!empty($excerpt)) return $excerpt;
        
        $content = $this->getTranslation('content', app()->getLocale()) ?? '';
        return mb_substr(strip_tags($content), 0, 150) . '...';
    }

    // SEO 分数
    public function getSeoScoreAttribute(): int
    {
        $score = 0;
        
        $title = $this->getTranslation('title', app()->getLocale()) ?? '';
        $titleLength = mb_strlen($title);
        if ($titleLength >= 10 && $titleLength <= 70) $score += 25;
        elseif ($titleLength > 0) $score += 15;
        
        $desc = $this->getTranslation('excerpt', app()->getLocale()) ?? '';
        if (mb_strlen($desc) >= 50) $score += 25;
        
        $content = $this->getTranslation('content', app()->getLocale()) ?? '';
        if (mb_strlen(strip_tags($content)) >= 300) $score += 30;
        elseif (mb_strlen(strip_tags($content)) > 0) $score += 15;
        
        if ($this->featured_image) $score += 10;
        if ($this->getTranslation('meta_title', app()->getLocale())) $score += 5;
        if ($this->getTranslation('meta_description', app()->getLocale())) $score += 5;
        
        return min(100, $score);
    }

    // Scout 搜索
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslation('title', app()->getLocale()),
            'excerpt' => $this->getTranslation('excerpt', app()->getLocale()),
            'content' => $this->getTranslation('content', app()->getLocale()),
            'slug' => $this->slug,
        ];
    }
}
