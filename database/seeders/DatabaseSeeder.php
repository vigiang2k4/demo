<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

     public function run(): void
     {
         $batchSize = 10000; // Đảm bảo không vượt quá giới hạn placeholders
         $categories = [];
         $startTime = microtime(true); // Bắt đầu đo thời gian
     
         DB::statement("ALTER TABLE categories DISABLE KEYS"); // Tắt index tạm thời
         DB::disableQueryLog(); // Tắt ghi log truy vấn để tiết kiệm bộ nhớ
     
         for ($i = 1; $i <= 1000000; $i++) {
             $categories[] = [
                 'name' => 'Category ' . $i,
                 'created_at' => now(),
                 'updated_at' => now(),
             ];
     
             if ($i % $batchSize === 0) {
                 DB::table('categories')->insert($categories);
                 $categories = []; // Giải phóng bộ nhớ
             }
     
             // Hiển thị tiến trình mỗi 100,000 bản ghi
             if ($i % 100000 === 0) {
                 echo "✅ Đã chèn $i bản ghi...\n";
             }
         }
     
         if (!empty($categories)) {
             DB::table('categories')->insert($categories);
         }
     
         DB::statement("ALTER TABLE categories ENABLE KEYS"); // Bật lại index
     
         $executionTime = round(microtime(true) - $startTime, 2);
         echo "\n✅ Seeder hoàn thành! Thời gian chạy: {$executionTime} giây\n";
     }
}
