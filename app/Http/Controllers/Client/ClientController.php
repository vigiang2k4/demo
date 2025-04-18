<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Variant\ColorRepositoryInterface;
use App\Repositories\Variant\SizeRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    protected $productRepo;
    protected $categoryRepo;
    protected $sizeRepo;
    protected $colorRepo;
    public function __construct(
        ProductRepositoryInterface $productRepo,
        CategoryRepositoryInterface $categoryRepo,
        SizeRepositoryInterface $sizeRepo,
        ColorRepositoryInterface $colorRepo
    ) {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
        $this->sizeRepo = $sizeRepo;
        $this->colorRepo = $colorRepo;
    }
    public function index()
    {
        try {
            $products = $this->productRepo->getAll()->where('status', 1);

            $products = $products->map(function ($product) {
                $product->cheapest_variant = $product->variants->sortBy('price')->first();
                return $product;
            });

            return view('client.shop.home', compact('products'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
    public function show($id)
    {
        try {

            $product = $this->productRepo->findById($id);

            if (!$product) {
                abort(404);
            }
            $relatedProducts = $this->productRepo->getRelatedProducts($product->category_id, $product->id);

            return view('client.shop.detail', compact('product', 'relatedProducts'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }


    public function shop()
    {
        return view('client.shop.shop');
    }
    public function about()
    {
        return view('client.other.about');
    }
    public function contact()
    {
        return view('client.other.contact');
    }
}
