<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Variant;
use App\Repositories\Cart\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function getUserCart($userId)
    {
        $cart = Cart::where('user_id', $userId)->first();
        $cart->load('cartItems');

        return $cart;
    }


    public function addItem($userId, $variantId, $quantity)
    {
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        $variant = Variant::findOrFail($variantId);

        $item = $cart->items()->where('variant_id', $variantId)->first();

        if ($item) {
            $newQuantity = min($item->quantity + $quantity, $variant->quantity);
            $item->update([
                'quantity' => $newQuantity,
                'total' => $newQuantity * $variant->price
            ]);
        } else {
            $quantity = min($quantity, $variant->quantity);
            $cart->items()->create([
                'variant_id' => $variantId,
                'quantity' => $quantity,
                'total' => $variant->price * $quantity,
            ]);
        }

        return $this->getUserCart($userId);
    }

    public function updateItem($userId, $variantId, $quantity)
    {
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        $variant = Variant::findOrFail($variantId);

        $quantity = min($quantity, $variant->quantity);

        $item = $cart->items()->where('variant_id', $variantId)->first();

        if ($item) {
            $item->update([
                'quantity' => $quantity,
                'total' => $quantity * $variant->price
            ]);
        }

        return $this->getUserCart($userId);
    }

    public function removeItem($userId, $variantId)
    {
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        $cart->items()->where('variant_id', $variantId)->delete();

        return $this->getUserCart($userId);
    }

    public function clearCart($userId)
    {
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        $cart->items()->delete();
        return $this->getUserCart($userId);
    }
}
