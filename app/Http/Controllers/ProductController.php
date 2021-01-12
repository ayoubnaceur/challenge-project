<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService =  $productService;
    }

    public function index()
    {
        $result = $this->productService->all();
        return ProductResource::collection($result);
    }

    public function store(Request $request)
    {
        return $this->productService->create($request);
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
        return $this->productService->delete($id);
    }
}
