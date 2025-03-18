<?php

namespace App\Repositories\Variant;

use App\Models\Size;
use App\Repositories\Variant\SizeRepositoryInterface;

class SizeRepository implements SizeRepositoryInterface
{
    public function getAll()
    {
        return Size::latest()->paginate(10);
    }

    public function findById($id)
    {
        return Size::findOrFail($id);
    }

    public function create(array $data)
    {
        return Size::create($data);
    }

    public function update($id, array $data)
    {
        $size = Size::findOrFail($id);
        $size->update($data);
        return $size;
    }

    public function delete($id)
    {
        return Size::destroy($id);
    }
}
