<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'fullname',
        'phone',
        'address',
        'email',
        'note',
        'total_quantity',
        'total',
        'status',
        'message',
        'payment_method',
        'payment_status',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
