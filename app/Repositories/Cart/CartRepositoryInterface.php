<?php
namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
    public function getUserCart($userId);
    public function addItem($userId, $variantId, $quantity);
    public function updateItem($userId, $variantId, $quantity);
    public function removeItem($userId, $variantId);
    public function clearCart($userId);
}
