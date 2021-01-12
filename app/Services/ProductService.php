<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ServiceInterface;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductResource;

class ProductService implements ServiceInterface
{

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function create(Request $data)
    {
        $validated = $data->validate([
            'name' => 'required|unique:products',
            'description' => 'required',
            'price' => 'required|numeric',
            'categories.*' => 'integer|array',
            'image' => 'required|file|image',
        ]);

        // if data is good do

        // move the image to local `storage` directory or (non elequent)
        $imagePath = $data->image->store('products','public');

        // prepare data in to be inserted
        $attributes = [
            "name" => $data->name,
            "description" => $data->description,
            "price" => $data->price,
            "image" => "storage/" . $imagePath
        ];

        $product = $this->productRepository->create($attributes);

        // make the productRepository equal a new productRepository with the new product data (preparing it to the be used in the attach method)
        // the attach methode could be in the 'create' function of the ProductRepository (but i make a global Repository to do not repate the creation elequant code)
        // we still have the ability to override the create function in the ProductRepository
        
        // create category-product link
        $this->productRepository->attach(array_map('intval', explode(',', $data->categories)));
        
        return new ProductResource($product);
    }

    public function createConsole($data)
    {
        $validated = $data->validate([
            'name' => 'required|unique:products',
            'description' => 'required',
            'price' => 'required|numeric',
            'categories.*' => 'integer',
            'image' => 'required',
        ]);

        // if data is good do

        // prepare data in to be inserted
        $attributes = [
            "name" => $data['name'],
            "description" => $data['description'],
            "price" => $data['price'],
            "image" => $data['image']
        ];

        $product = $this->productRepository->create($attributes);

        // make the productRepository equal a new productRepository with the new product data (preparing it to the be used in the attach method)
        // the attach methode could be in the 'create' function of the ProductRepository (but i make a global Repository to do not repate the creation elequant code)
        // we still have the ability to override the create function in the ProductRepository

        // create category-product link
        $this->productRepository->attach( $data['categories']);
        
        return new ProductResource($product);
    }

    public function find($id)
    {
        $product = $this->productRepository->find($id);
        return new ProductResource($product);
    }

    public function delete($id)
    {
        // find product
        $product = $this->productRepository->find($id);
        
        // remove image if its here
        // this is a Storage (non Eloquent) operation   
        // In case of the product entred by the CLI it will not be in the storage, so we check :)
        if (Storage::disk('public','products')->exists($product->image)) {
            Storage::disk('public','products')->delete($product->image);
        }

        // remove categories references
        $this->productRepository->detach();

        // return a response
        return $this->productRepository->delete();
    }

}