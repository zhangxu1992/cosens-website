<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Product extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia, SoftDeletes, Searchable;

    protected $fillable = [
        'category_id',
        'slug',
        'sku',
        'name',
        'description',
        'content',
        'specifications',
        'features',
        'applications',
        'base_price',
        'currency',
        'unit',
        'main_image',
        'gallery',
        'documents',
        'is_featured',
        'is_active',
        'sort_order',
        'view_count',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public $translatable = [
        'name',
        'description',
        'content',
        'specifications',
        'features',
        'applications',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'view_count' => 'integer',
        'base_price' => 'decimal:2',
        'gallery' => 'array',
        'documents' => 'array',
    ];

    // 分类
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // 询盘
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    // 报价
    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    // 活跃状态
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // 热门产品
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // 获取规格数组
    public function getSpecificationsArrayAttribute()
    {
        $specs = $this->getTranslation('specifications', app()->getLocale());
        if (empty($specs)) return [];
        
        // 解析规格字符串为数组
        $lines = explode("\n", $specs);
        $result = [];
        foreach ($lines as $line) {
            if (str_contains($line, ':')) {
                [$key, $value] = explode(':', $line, 2);
                $result[trim($key)] = trim($value);
            }
        }
        return $result;
    }

    // SEO 分数计算
    public function getSeoScoreAttribute(): int
    {
        $score = 0;
        
        // 标题长度检查 (10-30分)
        $title = $this->getTranslation('name', app()->getLocale()) ?? '';
        $titleLength = mb_strlen($title);
        if ($titleLength >= 10 && $titleLength <= 70) $score += 20;
        elseif ($titleLength > 0) $score += 10;
        
        // 描述检查 (10-20分)
        $desc = $this->getTranslation('description', app()->getLocale()) ?? '';
        $descLength = mb_strlen($desc);
        if ($descLength >= 50 && $descLength <= 160) $score += 20;
        elseif ($descLength > 0) $score += 10;
        
        // 内容长度检查 (10-30分)
        $content = $this->getTranslation('content', app()->getLocale()) ?? '';
        $contentLength = mb_strlen(strip_tags($content));
        if ($contentLength >= 500) $score += 30;
        elseif ($contentLength >= 300) $score += 20;
        elseif ($contentLength > 0) $score += 10;
        
        // 图片检查 (10-20分)
        if ($this->main_image) $score += 10;
        if (!empty($this->gallery)) $score += 10;
        
        // Meta 标签检查 (10分)
        if ($this->getTranslation('meta_title', app()->getLocale())) $score += 5;
        if ($this->getTranslation('meta_description', app()->getLocale())) $score += 5;
        
        return min(100, $score);
    }

    // Scout 搜索配置
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', app()->getLocale()),
            'description' => $this->getTranslation('description', app()->getLocale()),
            'slug' => $this->slug,
        ];
    }

    // 注册媒体集合
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('products')
            ->useDisk('public')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
    }
}
