<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            
            $table->string('code')->unique(); // mã giảm giá
            $table->string('description')->nullable(); // mô tả giảm giá
            $table->bigInteger('discount_value'); // giá trị giảm giá (giảm theo tiền tệ, ví dụ 5000 VND)
            $table->bigInteger('min_order_value'); // giá trị tối thiểu của đơn hàng để áp dụng voucher (ví dụ 10000 VND)
            
            $table->date('valid_from'); // ngày bắt đầu áp dụng
            $table->date('valid_until'); // ngày kết thúc áp dụng
        
            $table->tinyInteger('is_active')->default(0); // trạng thái hoạt động (0: không hoạt động, 1: hoạt động)
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
