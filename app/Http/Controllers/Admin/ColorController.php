<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Repositories\ColorRepositoryInterface;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected $colorRepo;

    public function __construct(ColorRepositoryInterface $colorRepo)
    {
        $this->colorRepo = $colorRepo;
    }

    public function index()
    {
        $colors = $this->colorRepo->getAll();
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(ColorRequest $request)
    {
        $this->colorRepo->create($request->validated());
        return redirect()->route('colors.index')->with('success', 'Màu sắc đã được thêm.');
    }

    public function edit($id)
    {
        $color = $this->colorRepo->findById($id);
        return view('admin.colors.edit', compact('color'));
    }

    public function update(ColorRequest $request, $id)
    {
        $this->colorRepo->update($id, $request->validated());
        return redirect()->route('colors.index')->with('success', 'Màu sắc đã được cập nhật.');
    }

    public function destroy($id)
    {
        $this->colorRepo->delete($id);
        return redirect()->route('colors.index')->with('success', 'Màu sắc đã được xóa.');
    }
}
