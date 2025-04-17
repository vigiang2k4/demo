<?php

use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->string('fullname');
            $table->string('phone');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('note')->nullable();
            $table->bigInteger('total_quantity');
            $table->bigInteger('total');
            $table->tinyInteger('status')->default(0);// 0: chờ xác nhận, 1: đã xác nhận, 2: đang giao hàng, 3: đã giao hàng, 4: đã hủy
            $table->string('message')->nullable();
            $table->integer('payment_method')->default('0');// 0: cod, 1: chuyển khoản ngân hàng
            $table->string('payment_status')->default('pending');// pending: chờ thanh toán, paid: đã thanh toán, failed: thanh toán thất bại
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
