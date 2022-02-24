<?php

namespace App\Models;

use DateTimeInterface;
use App\Models\Manufacturer;
use App\Models\PurchaseItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'manufacturer_id',
        'invoice_no',
        'purchase_date',
        'sub_total',
        'vat',
        'discount',
        'grand_total',
        'paid_amount',
        'due_amount',
    ];
    protected $casts = [
        'purchase_date' => 'date'
    ];


    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest_invoice = \App\Models\Purchase::withTrashed()->latest()->max('id') + 1;
            $model->invoice_no = 'PR-' . str_pad((int)$latest_invoice, 6, '0', STR_PAD_LEFT);
        });
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
