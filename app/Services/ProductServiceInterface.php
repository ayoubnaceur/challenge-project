<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;


interface ProductServiceInterface
{

    public function all();
    public function create(Request $data);
    public function find($id);
    public function delete($id);
}