<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;
use App\Services\ProductServiceInterface;
use Illuminate\Support\Facades\Storage;


class ProductService implements ProductServiceInterface
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function create(Request $data)
    {
        $v = Validator::make($data->all(), [
            'name' => 'required|unique:products',
            'description' => 'required',
            'price' => 'required|numeric',
            'categories.*' => 'integer|array',
            'image' => 'required|file|image',
        ]);

        if ($v->fails()) {
            return response()->json($v->errors(),422);
        }

        // move the image to local `storage` directory or (non elequent)
        $imagePath = $data->image->store('products','public');

        // prepare data in to be inserted
        $attributes = [
            "name" => $data->name,
            "description" => $data->description,
            "price" => $data->price,
            "image" => "storage/" . $imagePath
        ];

        $p = $this->repository->create($attributes);

        // make the repository equal a new repository with the new product data (preparing it to the be used in the attach method)
        // the attach methode could be in the 'create' function of the ProductRepository (but i make a global Repository to do not repate the creation elequant code)
        // we still have the ability to override the create function in the ProductRepository
        
        // create category-product link
        $this->repository->attach(array_map('intval', explode(',', $data->categories)));
        
        return new ProductResource($p);
    }

    public function find($id)
    {
        $p = $this->repository->find($id);
        return new ProductResource($p);
    }

    public function delete($id)
    {
        // find product
        $p = $this->repository->find($id);
        
        // remove image if its here
        // this is a Storage (non Eloquent) operation   
        // In case of the product entred by the CLI it will not be in the storage, so we check :)
        if (Storage::disk('public','products')->exists($p->image)) {
            Storage::disk('public','products')->delete($p->image);
        }

        // remove categories references
        $this->repository->detach();

        // return a response
        return $this->repository->delete();
    }

}