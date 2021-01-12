<?php

namespace App\Services;

use Exception;
use App\Models\Category;
use InvalidArgumentException;
use App\Http\Resources\ProductResource;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;

class CategoryService implements ServiceInterface
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function find($id)
    {
        $category = $this->categoryRepository->find($id);
        return new CategoryResource($category);
    }

    public function create($data)
    {
        $validator = Validator::make($data, [
            "name" => "required|unique:categories",
            "category_id" => "nullable|numeric|exists:categories,id"
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $this->categoryRepository->create($data);
    }

    public function delete($id)
    {
        $this->categoryRepository->find($id);
        return $this->categoryRepository->delete();
    }

}