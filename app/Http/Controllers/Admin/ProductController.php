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
        $products = $this->productRepo->getAll();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->getAll();
        $colors = $this->colorRepo->getAll();
        $sizes = $this->sizeRepo->getAll();
        return view('admin.products.create', compact('categories', 'colors', 'sizes'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $this->productRepo->create($request->getvalidated());
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
        } catch (Exception $e) {
            Log::error('Lỗi khi thêm sản phẩm: ' . $e->getMessage());
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function edit(int $id)
    {
        $product = $this->productRepo->findById($id);
        $categories = Category::all(); 
        $colors = Color::all(); 
        $sizes = Size::all(); 

        return view('admin.products.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

    public function update(ProductRequest $request, int $id)
    {
        try {
            $this->productRepo->update($id, $request->validated());
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật.');
        } catch (Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->productRepo->delete($id);
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã bị xóa.');
        } catch (Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
