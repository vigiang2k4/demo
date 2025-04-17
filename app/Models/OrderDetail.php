<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'variant_id',
        'product_name',
        'product_name',
        'variant_color',
        'variant_size',
        'variant_avatar',
        'quantity',
        'price',
        'total',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
