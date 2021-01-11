<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    public function attach(array $attributes);
    public function detach();
    public function delete();
}


