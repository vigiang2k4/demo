<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Variant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::with(['category', 'variants.color', 'variants.size', 'images'])->paginate(10);
    }

    public function findById($id)
    {
        return Product::with(['category', 'variants.color', 'variants.size', 'images'])->findOrFail($id);
    }

    public function create($data)
    {
        DB::beginTransaction();

        try {
            // Tạo sản phẩm mới
            $product = Product::create([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'description' => $data['description'] ?? null,
                'avatar' => $data['avatar'] ?? null,
            ]);

            // Lưu ảnh bộ sưu tập nếu có
            if (!empty($data['image'])) {
                foreach ($data['image'] as $imagePath) {
                    $product->images()->create(['image' => $imagePath]);
                }
            }

            // Lưu các biến thể sản phẩm nếu có
            if (!empty($data['variants'])) {
                foreach ($data['variants'] as $variant) {
                    Variant::create([
                        'product_id' => $product->id,
                        'color_id' => $variant['color_id'],
                        'size_id' => $variant['size_id'],
                        'quantity' => $variant['quantity'],
                        'price' => $variant['price'],
                        'avatar' => $variant['avatar'] ?? null,
                    ]);
                }
            }

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($id, $data)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);

            // ✅ Xóa ảnh cũ nếu có ảnh mới
            if (!empty($data['avatar'])) {
                if (!empty($product->avatar)) {
                    Storage::disk('public')->delete($product->avatar);
                }
                $data['avatar'] = $data['avatar']->store('products', 'public');
            }

            // ✅ Cập nhật thông tin sản phẩm
            $product->update([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'description' => $data['description'] ?? null,
                'avatar' => $data['avatar'] ?? $product->avatar,
            ]);

            // ✅ Xử lý ảnh bộ sưu tập
            if (!empty($data['image'])) {
                foreach ($data['image'] as $file) {
                    $product->images()->create([
                        'image' => $file->store('product_images', 'public'),
                    ]);
                }
            }

            // ✅ Xử lý biến thể
            $existingVariantIds = $product->variants->pluck('id')->toArray();
            $newVariantIds = [];

            if (!empty($data['variants'])) {
                foreach ($data['variants'] as $variantData) {
                    $variant = Variant::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'color_id' => $variantData['color_id'],
                            'size_id' => $variantData['size_id'],
                        ],
                        [
                            'quantity' => $variantData['quantity'],
                            'price' => $variantData['price'],
                        ]
                    );

                    // ✅ Xử lý ảnh của biến thể
                    if (!empty($variantData['avatar'])) {
                        if (!empty($variant->avatar)) {
                            Storage::disk('public')->delete($variant->avatar);
                        }
                        $variant->avatar = $variantData['avatar']->store('variants', 'public');
                        $variant->save();
                    }

                    $newVariantIds[] = $variant->id;
                }
            }

            // ✅ Xóa các biến thể không còn tồn tại
            $variantsToDelete = array_diff($existingVariantIds, $newVariantIds);
            if (!empty($variantsToDelete)) {
                Variant::whereIn('id', $variantsToDelete)->delete();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi cập nhật sản phẩm: ' . $e->getMessage());
            throw new \Exception('Có lỗi xảy ra khi cập nhật sản phẩm.');
        }
    }


    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $product = Product::findOrFail($id);
            $product->delete();
        });
    }
}
