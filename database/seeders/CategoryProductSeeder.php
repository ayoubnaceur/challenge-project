<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // the product 1 (headsets) is under the global category (computer pieces)
        DB::table('category_product')->insert([
            'product_id' => 1,
            'category_id' => 2
        ]);

        // the product with number 2 (Hp computer keyboard) is under the speciphic sub-category 2 (keyboard)
        DB::table('category_product')->insert([
            'product_id' => 2,
            'category_id' => 3
        ]);
    }
}
