<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        try {
            $categories = $this->categoryRepo->getAll();
            return view('admin.categories.index', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi tải danh mục: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->getImage();
            
            $this->categoryRepo->create($data);
    
            return redirect()->route('categories.index')->with('success', 'Danh mục đã được tạo thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi tạo danh mục: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $category = $this->categoryRepo->findById($id);
            return view('categories.edit', compact('category'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không tìm thấy danh mục: ' . $e->getMessage());
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $this->categoryRepo->update($id, $request->validated());
            return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi cập nhật danh mục: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoryRepo->delete($id);
            return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi xóa danh mục: ' . $e->getMessage());
        }
    }
}
