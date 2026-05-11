<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'label',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'value' => 'array',
        'sort_order' => 'integer',
    ];

    // 缓存键
    const CACHE_KEY = 'site_settings';

    // 获取所有设置（带缓存）
    public static function getAll(): array
    {
        return Cache::remember(self::CACHE_KEY, 3600, function () {
            $settings = self::all();
            $result = [];
            
            foreach ($settings as $setting) {
                $result[$setting->group][$setting->key] = $setting->getValue();
            }
            
            return $result;
        });
    }

    // 获取单个设置值
    public static function get(string $key, string $group = 'general', $default = null)
    {
        $settings = self::getAll();
        return $settings[$group][$key] ?? $default;
    }

    // 获取多语言设置值
    public static function getTranslated(string $key, string $group = 'general', ?string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $value = self::get($key, $group);
        
        if (is_array($value) && isset($value[$locale])) {
            return $value[$locale];
        }
        
        return is_string($value) ? $value : null;
    }

    // 设置值
    public static function set(string $key, $value, string $group = 'general'): void
    {
        $setting = self::firstOrCreate(
            ['group' => $group, 'key' => $key],
            ['type' => 'text', 'label' => [$group => $key], 'value' => []]
        );
        
        $setting->value = is_array($value) ? $value : [$value];
        $setting->save();
        
        // 清除缓存
        Cache::forget(self::CACHE_KEY);
    }

    // 获取当前语言下的值
    public function getValue(?string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $value = $this->value;
        
        if (!is_array($value)) {
            return $value;
        }
        
        // 如果是多语言数组
        if (isset($value[$locale])) {
            return $value[$locale];
        }
        
        // 返回第一个非空值
        foreach ($value as $v) {
            if (!empty($v)) return $v;
        }
        
        return null;
    }

    // 清除缓存
    protected static function boot()
    {
        parent::boot();
        
        static::saved(function () {
            Cache::forget(self::CACHE_KEY);
        });
        
        static::deleted(function () {
            Cache::forget(self::CACHE_KEY);
        });
    }

    // 常用设置快捷方法
    public static function siteName(): string
    {
        return self::getTranslated('site_name') ?? 'Cosens';
    }

    public static function siteLogo(): ?string
    {
        return self::get('site_logo');
    }

    public static function contactEmail(): ?string
    {
        return self::get('contact_email');
    }

    public static function contactPhone(): ?string
    {
        return self::get('contact_phone');
    }

    public static function whatsappNumber(): ?string
    {
        return self::get('whatsapp_number');
    }

    public static function address(): ?string
    {
        return self::getTranslated('address');
    }

    public static function socialLinks(): array
    {
        return self::get('social_links', 'general', []);
    }
}
