<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'customer_id',
        'invoice_no',
        'sales_date',
        'invoice_discount',
        'total_discount',
        'vat',
        'grand_total',
        'paid_amount',
        'exchange_amount',
    ];

    protected $casts = [
        'sales_date' => 'date',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesItems()
    {
        return $this->hasMany(SalesItem::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest_invoice = \App\Models\Sale::withTrashed()->latest()->max('id') + 1;
            $model->invoice_no = 'SL-' . str_pad((int)$latest_invoice, 6, '0', STR_PAD_LEFT);
        });
    }

    // Scopes
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->whereHas('manufacturer', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
