<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'buyer_name',
        'subtotal',
        'iva',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
