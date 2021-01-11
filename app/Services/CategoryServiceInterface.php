<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface CategoryServiceInterface
{
    public function all();
    public function create($data);
    public function delete($id);
}