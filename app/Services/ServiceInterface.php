<?php

namespace App\Services;

use Illuminate\Http\Request;

interface ServiceInterface
{
    public function all();
    public function create(Request $data);
    public function find($id);
    public function delete($id);
}