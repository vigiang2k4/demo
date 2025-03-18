<?php

namespace App\Repositories\Variant;

use App\Models\Color;
use App\Repositories\Variant\ColorRepositoryInterface;

class ColorRepository implements ColorRepositoryInterface
{
    public function getAll()
    {
        return Color::latest()->paginate(10);
    }

    public function findById($id)
    {
        return Color::findOrFail($id);
    }

    public function create(array $data)
    {
        return Color::create($data);
    }

    public function update($id, array $data)
    {
        $color = Color::findOrFail($id);
        $color->update($data);
        return $color;
    }

    public function delete($id)
    {
        return Color::destroy($id);
    }
}
