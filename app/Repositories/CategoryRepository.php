<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\CategoryRepositoryInterface;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{

    public function __construct(Category $categoryModel)
    {
        parent::__construct($categoryModel);
    }

    public function delete()
    {
        // disconnect subcategories

        /*
        ** [ ] we can make them as root categories by setting 'category_id' to 'null'
        ** [x] we can make them as sub-categories of an additional root category 'other'
        **     In CategorySedder the 'other' category is the first thing seeded (id = 1)
        ** [ ] we can drope them recurcivly
        */
        $this->categoryModel->children()->update(['category_id' => 1 ]);
        
        // delete category
        $result = $this->categoryModel;
        $this->categoryModel->delete();
        return $result;
    }
}