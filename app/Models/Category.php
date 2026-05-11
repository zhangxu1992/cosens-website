<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'type',
        'slug',
        'sort_order',
        'is_active',
        'icon',
        'image',
        'name',
        'description',
        'meta_title',
        'meta_description',
    ];

    public $translatable = [
        'name',
        'description',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // 父分类
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // 子分类
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order');
    }

    // 所有子分类（递归）
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    // 根据类型获取
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    // 活跃状态
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // 顶级分类
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    // 获取树形结构
    public static function getTree($type = 'product')
    {
        return self::ofType($type)
            ->active()
            ->root()
            ->with(['children' => function($q) {
                $q->active()->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();
    }
}
