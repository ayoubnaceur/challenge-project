<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface RepositoryInterface
{

    public function all();
    
    public function find($id);

    public function create(array $attributes);

}

