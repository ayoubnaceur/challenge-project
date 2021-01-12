<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Services\ProductService;

class createProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appdo:createProduct
                    {name : The name of product}
                    {description : The description of the product}
                    {price : The price of the product}
                    {image : The link of the product image}
                    {categories?* : At list 1 category id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a product';

    protected $service;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductService $service)
    {
        parent::__construct();
        $this->service =  $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = [
            'name' => $this->argument('name'),
            'description' => $this->argument('description'),
            'price' => $this->argument('price'),
            'image' => $this->argument('image'),
            'categories' => $this->argument('categories'),
        ];
        
        try {
            $result = $this->service->createConsole($data);

            $this->table(
                ['Id','Name'],
                [[$result->id, $result->name]]
            );

            $this->info('Product created successfuly!');

        } catch (Exception $e) {
            $this->error('Something went wrong!'. $e->getMessage());
        }
    }
}
