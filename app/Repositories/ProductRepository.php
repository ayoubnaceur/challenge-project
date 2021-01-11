<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\ProductRepositoryInterface;

class ProductRepository extends Repository implements ProductRepositoryInterface
{

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function attach(array $attributes)
    {
        $this->model->categories()->attach($attributes);
        return null;
    }

    public function detach()
    {
        $this->model->categories()->detach();
        return null;
    }

    public function delete()
    {
        $instance = $this->model;
        $this->model->delete();
        return $instance;
    }

}