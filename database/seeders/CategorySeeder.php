<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //the next category is principale
        //it is used as a root category for sub-categories when we delete the parent category 
        
        Category::create([
            'name'=> 'Other',
            'category_id'=> null
        ]);

        // create a root category
        Category::create([
            'name'=> 'Computer pieces',
            'category_id'=> null
        ]);

        // create a sub-category category
        Category::create([
            'name'=> 'Keyboard',
            'category_id'=> 2
        ]);
    }
}
