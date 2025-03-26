<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::latest()->paginate(10);
    }

    public function findById($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $category = Category::findOrFail($id);

        if (!empty($data['avatar']) && is_file($data['avatar'])) {
            $newImagePath = $data['avatar']->store('categories', 'public');

            if ($category->avatar) {
                Storage::disk('public')->delete($category->avatar);
            }

            $data['avatar'] = $newImagePath;
        } else {
            unset($data['avatar']);
        }

        $category->update($data);

        return $category;
    }



    public function delete($id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }
}
