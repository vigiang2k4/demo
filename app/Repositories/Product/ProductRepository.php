<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::latest()->paginate(10);
    }

    public function findById($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Tạo sản phẩm
            $product = Product::create([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'avatar' => $data['avatar'] ?? null,
            ]);

            // Lưu bộ sưu tập ảnh (nếu có)
            if (!empty($data['gallery'])) {
                foreach ($data['gallery'] as $imagePath) {
                    $product->images()->create(['image' => $imagePath]);
                }
            }

            // Lưu biến thể sản phẩm
            foreach ($data['variants'] as $variant) {
                $product->variants()->create([
                    'color_id' => $variant['color_id'],
                    'size_id' => $variant['size_id'],
                    'quantity' => $variant['quantity'],
                    'stock' => 0, // Mặc định số lượng đã bán = 0
                    'avatar' => $variant['avatar'] ?? null,
                ]);
            }

            return $product;
        });
    }

    public function update($id, array $data)
    {
        $product = $this->findById($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->findById($id);
        return $product->delete();
    }
}
