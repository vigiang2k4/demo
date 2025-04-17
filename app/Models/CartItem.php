<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = ['cart_id', 'variant_id', 'quantity', 'total',];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
    
    // Tính toán total tự động
    public function calculateTotal()
    {
        $this->total = $this->quantity * $this->price;
    }

}
