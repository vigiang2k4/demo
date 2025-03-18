<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepo;
    protected $categoryRepo;

    public function __construct(ProductRepositoryInterface $productRepo, CategoryRepositoryInterface $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->getAll();
        return view('products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $this->productRepo->create($request->validated());
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo.');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function edit(int $id)
    {
        $product = $this->productRepo->findById($id);
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, int $id)
    {
        try {
            $this->productRepo->update($id, $request->validated());
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật.');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->productRepo->delete($id);
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã bị xóa.');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
