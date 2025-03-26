<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Variant;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Variant\ColorRepositoryInterface;
use App\Repositories\Variant\SizeRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductController extends Controller
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
        try{
            $products = $this->productRepo->getAll();
            return view('admin.products.index', compact('products'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function create()
    {
        try{
            $categories = $this->categoryRepo->getAll();
            $colors = $this->colorRepo->getAll();
            $sizes = $this->sizeRepo->getAll();
            return view('admin.products.create', compact('categories', 'colors', 'sizes'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            $this->productRepo->create($request->getvalidated());
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
        } catch (Exception $e) {
            Log::error('Lỗi khi thêm sản phẩm: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function edit(int $id)
    {
        try{
            $product = $this->productRepo->findById($id);
            $categories = $this->categoryRepo->getAll();
            $colors = $this->colorRepo->getAll();
            $sizes = $this->sizeRepo->getAll();
            return view('admin.products.edit', compact('product', 'categories', 'colors', 'sizes'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function update(ProductRequest $request, int $id)
    {
        try {
            $this->productRepo->update($id, $request->validated());
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->productRepo->delete($id);
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã bị xóa.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
}
