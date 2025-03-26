<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Repositories\Variant\SizeRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SizeController extends Controller
{
    protected $sizeRepo;

    public function __construct(SizeRepositoryInterface $sizeRepo)
    {
        $this->sizeRepo = $sizeRepo;
    }

    public function index()
    {
        try {
            $sizes = $this->sizeRepo->getAll();
            return view('admin.sizes.index', compact('sizes'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(SizeRequest $request)
    {
        try {
            $this->sizeRepo->create($request->validated());
            return redirect()->route('sizes.index')->with('success', 'Kích thước đã được thêm.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function edit($id)
    {
        try {
            $size = $this->sizeRepo->findById($id);
            return view('admin.sizes.edit', compact('size'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function update(SizeRequest $request, $id)
    {
        try {
            $this->sizeRepo->update($id, $request->validated());
            return redirect()->route('sizes.index')->with('success', 'Kích thước đã được cập nhật.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->sizeRepo->delete($id);
            return redirect()->route('sizes.index')->with('success', 'Kích thước đã được xóa.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
}
