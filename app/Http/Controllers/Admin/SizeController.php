<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Repositories\Variant\SizeRepositoryInterface;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    protected $sizeRepo;

    public function __construct(SizeRepositoryInterface $sizeRepo)
    {
        $this->sizeRepo = $sizeRepo;
    }

    public function index()
    {
        $sizes = $this->sizeRepo->getAll();
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(SizeRequest $request)
    {
        $this->sizeRepo->create($request->validated());
        return redirect()->route('sizes.index')->with('success', 'Kích thước đã được thêm.');
    }

    public function edit($id)
    {
        $size = $this->sizeRepo->findById($id);
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(SizeRequest $request, $id)
    {
        $this->sizeRepo->update($id, $request->validated());
        return redirect()->route('sizes.index')->with('success', 'Kích thước đã được cập nhật.');
    }

    public function destroy($id)
    {
        $this->sizeRepo->delete($id);
        return redirect()->route('sizes.index')->with('success', 'Kích thước đã được xóa.');
    }
}
