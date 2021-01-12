<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    
    public function index()
    {
        $result = $this->categoryService->all();

        // formating output as json api responds
        return CategoryResource::collection($result);
    }

    public function store(Request $request)
    {
        // input
        $data = $request->only([
            'name',
            'category_id',
        ]);
        
        try {
            $result = $this->categoryService->create($data);
            return new CategoryResource($result);
        } catch (Exception $e) {
            return [
                'status' => 400,
                'error' => $e->getMessage()
            ];
        }
        
    }

    public function show($id)
    {
        // nothing here too; this is a route ...
    }

    public function update(Request $request, $id)
    {
        // nothing here too; this is a route ...
    }

    public function destroy($id)
    {
        return $this->categoryService->delete($id);
    }
}
