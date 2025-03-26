<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getRelatedProducts($categoryId, $excludeProductId, $limit = 4);
}