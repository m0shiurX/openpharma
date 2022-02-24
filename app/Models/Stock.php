<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'expiry_date' => 'date:Y-m-d'
    ];

    protected $fillable = [
        'medicine_id',
        'batch_id',
        'expiry_date',
        'stock',
    ];


    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
