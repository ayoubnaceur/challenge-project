<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository; 
use App\Repositories\CategoryRepositoryInterface; 
use App\Repositories\ProductRepositoryInterface; 

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
