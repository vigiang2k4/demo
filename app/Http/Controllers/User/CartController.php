<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class CartController extends Controller
{
    protected $cartRepo;

    public function __construct(CartRepositoryInterface $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    public function index()
    {
        try {
            $cart = $this->cartRepo->getUserCart(Auth::id());
            $cart->load('cartItems');
            return view('client.cart.index', compact('cart'));
        } catch (Exception $e) {
            Log::error('Cart Index Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi hiển thị giỏ hàng.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'variant_id' => 'required|exists:variants,id',
                'quantity' => 'required|integer|min:1'
            ]);

            $this->cartRepo->addItem(Auth::id(), $request->variant_id, $request->quantity);

            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
        } catch (Exception $e) {
            Log::error('Cart Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Không thể thêm sản phẩm vào giỏ hàng.');
        }
    }

    public function update(Request $request, $variantId)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1'
            ]);

            $this->cartRepo->updateItem(Auth::id(), $variantId, $request->quantity);

            return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công.');
        } catch (Exception $e) {
            Log::error('Cart Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Không thể cập nhật sản phẩm trong giỏ hàng.');
        }
    }

    public function destroy($variantId)
    {
        try {
            $this->cartRepo->removeItem(Auth::id(), $variantId);

            return redirect()->back()->with('success', 'Đã xoá sản phẩm khỏi giỏ hàng.');
        } catch (Exception $e) {
            Log::error('Cart Destroy Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Không thể xoá sản phẩm khỏi giỏ hàng.');
        }
    }

    public function clear()
    {
        try {
            $this->cartRepo->clearCart(Auth::id());

            return redirect()->back()->with('success', 'Đã xoá toàn bộ giỏ hàng.');
        } catch (Exception $e) {
            Log::error('Cart Clear Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Không thể xoá toàn bộ giỏ hàng.');
        }
    }
}
