<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\ProductRepositoryInterface;

class ProductRepository extends Repository implements ProductRepositoryInterface
{

    public function __construct(Product $productModel)
    {
        parent::__construct($productModel);
    }

    public function attach(array $attributes)
    {
        $this->productModel->categories()->attach($attributes);
        return null;
    }

    public function detach()
    {
        $this->productModel->categories()->detach();
        return null;
    }

    public function delete()
    {
        $result = $this->productModel;
        $this->productModel->delete();
        return $result;
    }

}