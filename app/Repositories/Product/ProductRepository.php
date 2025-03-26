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
        return Product::with([
            'category',
            'variants' => function ($query) {
                $query->orderBy('price', 'asc');
            },
            'variants.color',
            'variants.size',
            'images'
        ])->findOrFail($id);
    }


    public function create($data)
    {
        DB::beginTransaction();

        try {
            $product = Product::create([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'description' => $data['description'] ?? null,
                'avatar' => $data['avatar'] ?? null,
            ]);

            if (!empty($data['image'])) {
                foreach ($data['image'] as $imagePath) {
                    $product->images()->create(['image' => $imagePath]);
                }
            }

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

            if (!empty($data['avatar'])) {
                if (!empty($product->avatar)) {
                    Storage::disk('public')->delete($product->avatar);
                }
                $data['avatar'] = $data['avatar']->store('products', 'public');
            }

            $product->update([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'description' => $data['description'] ?? null,
                'avatar' => $data['avatar'] ?? $product->avatar,
            ]);

            if (!empty($data['image'])) {
                foreach ($data['image'] as $file) {
                    $product->images()->create([
                        'image' => $file->store('product_images', 'public'),
                    ]);
                }
            }

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
    public function getRelatedProducts($categoryId, $excludeProductId, $limit = 4)
    {
        return Product::where('category_id', $categoryId)
            ->where('id', '!=', $excludeProductId)
            ->limit($limit)
            ->get();
    }
}
