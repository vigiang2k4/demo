<?php

use App\Models\Order;
use App\Models\User;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();  // Nếu User bị xóa, đánh giá sẽ không bị xóa
            $table->foreignIdFor(Order::class)->nullable()->constrained()->nullOnDelete();  // Nếu Order bị xóa, đánh giá sẽ không bị xóa
            $table->foreignIdFor(Variant::class)->nullable()->constrained()->cascadeOnDelete();  // Nếu Variant bị xóa, đánh giá sẽ bị xóa
            $table->string('image')->nullable();
            $table->tinyInteger('rating')->default(5); // Thang điểm 5
            $table->text('comment')->nullable();
            $table->boolean('is_reviews')->default(1);  // Đã đánh giá = 1, chưa đánh giá = 0
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
