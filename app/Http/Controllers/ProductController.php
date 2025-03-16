<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $productRepo;
    protected $categoryRepo;

    public function __construct(ProductRepositoryInterface $productRepo, CategoryRepositoryInterface $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index(): View
    {
        $products = $this->productRepo->getAll();
        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = $this->categoryRepo->getAll();
        return view('products.create', compact('categories'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        try {
            $this->productRepo->create($request->validated());
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo.');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function edit(int $id): View
    {
        $product = $this->productRepo->findById($id);
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, int $id): RedirectResponse
    {
        try {
            $this->productRepo->update($id, $request->validated());
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật.');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->productRepo->delete($id);
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã bị xóa.');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
