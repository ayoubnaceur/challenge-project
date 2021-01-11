<?php

namespace App\Services;

use Exception;
use App\Models\Category;
use InvalidArgumentException;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use App\Services\CategoryServiceInterface;


class CategoryService implements CategoryServiceInterface
{

    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
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

        return $this->repository->create($data);
    }

    public function delete($id)
    {
        $this->repository->find($id);
        return $this->repository->delete();
    }

}