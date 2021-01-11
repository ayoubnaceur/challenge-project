<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // we can use factory but its better to have less & significant data in building 
        // product 01
        Product::create([
            'name'=> 'Headsets',
            'description'=> 'Headsets description',
            'price'=> 100,
            'image'=> 'storage/products/example.png',
        ]);


        // product 02
        Product::create([
            'name'=> 'Hp computer keyboard',
            'description'=> 'Hp computer keyboard description',
            'price'=> 300,
            'image'=> 'storage/products/example.png',
        ]);
    }
}
