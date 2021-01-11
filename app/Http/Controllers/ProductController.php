<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service =  $service;
    }

    public function index()
    {
        $result = $this->service->all();
        return ProductResource::collection($result);
    }

    public function store(Request $request)
    {
        return $this->service->create($request);
    }

    public function show($id)
    {
        // nothing here :) ; its a rout function
    }


    public function update(Request $request, $id)
    {
        // nothing here :) ; its a rout function
    }


    public function destroy($id)
    {   
        return $this->service->delete($id);
    }
}
