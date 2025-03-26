<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Repositories\Variant\ColorRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{
    protected $colorRepo;

    public function __construct(ColorRepositoryInterface $colorRepo)
    {
        $this->colorRepo = $colorRepo;
    }

    public function index()
    {
        try{
            $colors = $this->colorRepo->getAll();
            return view('admin.colors.index', compact('colors'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(ColorRequest $request)
    {
        try{
            $this->colorRepo->create($request->validated());
            return redirect()->route('colors.index')->with('success', 'Màu sắc đã được thêm.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function edit($id)
    {
        try{
            $color = $this->colorRepo->findById($id);
            return view('admin.colors.edit', compact('color'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function update(ColorRequest $request, $id)
    {
        try{
            $this->colorRepo->update($id, $request->validated());
            return redirect()->route('colors.index')->with('success', 'Màu sắc đã được cập nhật.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function destroy($id)
    {
        try{
            $this->colorRepo->delete($id);
            return redirect()->route('colors.index')->with('success', 'Màu sắc đã được xóa.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
}
