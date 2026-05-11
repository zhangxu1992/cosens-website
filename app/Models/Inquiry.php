<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_number',
        'name',
        'email',
        'phone',
        'company_name',
        'country',
        'message',
        'product_ids',
        'status',
        'admin_notes',
        'replied_at',
        'replied_by',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'product_ids' => 'array',
        'replied_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($inquiry) {
            if (empty($inquiry->inquiry_number)) {
                $inquiry->inquiry_number = 'INQ-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            }
        });
    }

    public function products()
    {
        if (empty($this->product_ids)) return collect();
        return Product::whereIn('id', $this->product_ids)->get();
    }

    public function repliedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // 状态颜色（用于后台显示）
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'processing' => 'info',
            'replied' => 'success',
            'completed' => 'success',
            'closed' => 'gray',
            default => 'gray',
        };
    }

    // 状态标签
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => '待处理',
            'processing' => '处理中',
            'replied' => '已回复',
            'completed' => '已完成',
            'closed' => '已关闭',
            default => '未知',
        };
    }
}
