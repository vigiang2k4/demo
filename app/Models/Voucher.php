<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'description',
        'value',
        'min_order',
        'start',
        'end',
        'is_active',
    ];
    

    public function usages()
    {
        return $this->hasMany(VoucherUsage::class);
    }
}
