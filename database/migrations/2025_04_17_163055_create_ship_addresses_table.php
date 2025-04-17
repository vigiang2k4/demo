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
        Schema::create('ship_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
        
            $table->string('fullname');
            $table->string('phone');
            $table->string('address'); // địa chỉ chi tiết (số nhà, đường)
            $table->string('ward')->nullable(); // phường/xã
            $table->string('district')->nullable(); // quận/huyện
            $table->string('province')->nullable(); // tỉnh/thành phố
        
            $table->tinyInteger('is_default')->default(0); // địa chỉ mặc định (0: không phải, 1: là địa chỉ mặc định)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_addresses');
    }
};
