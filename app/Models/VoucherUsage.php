<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherUsage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'voucher_id',
        'order_id',
        'value'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
