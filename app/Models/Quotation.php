<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_number',
        'inquiry_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_company',
        'product_id',
        'quantity',
        'specifications',
        'unit_price',
        'total_price',
        'currency',
        'status',
        'valid_until',
        'notes',
        'terms',
        'sent_at',
        'accepted_at',
        'created_by',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'valid_until' => 'date',
        'sent_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($quotation) {
            if (empty($quotation->quotation_number)) {
                $quotation->quotation_number = 'QT-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            }
        });
        
        static::saving(function ($quotation) {
            // 自动计算总价
            if ($quotation->unit_price && $quotation->quantity) {
                $quotation->total_price = $quotation->unit_price * $quotation->quantity;
            }
        });
    }

    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    // 状态颜色
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'draft' => 'gray',
            'sent' => 'info',
            'accepted' => 'success',
            'rejected' => 'danger',
            'expired' => 'warning',
            default => 'gray',
        };
    }

    // 是否过期
    public function getIsExpiredAttribute(): bool
    {
        if (!$this->valid_until) return false;
        return $this->valid_until < now();
    }

    // 格式化金额
    public function getFormattedUnitPriceAttribute(): string
    {
        return $this->currency . ' ' . number_format($this->unit_price, 2);
    }

    public function getFormattedTotalPriceAttribute(): string
    {
        return $this->currency . ' ' . number_format($this->total_price, 2);
    }
}
