<?php

use App\Models\Order;
use App\Models\Variant;
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Variant::class)->nullable()->constrained()->nullOnDelete(); // nullable để vẫn giữ record nếu variant bị xoá
            $table->string('product_name');
            $table->string('variant_color')->nullable();
            $table->string('variant_size')->nullable();
            $table->string('variant_avatar')->nullable();
            $table->integer('quantity');
            $table->bigInteger('price');
            $table->bigInteger('total'); // giá lúc mua
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
