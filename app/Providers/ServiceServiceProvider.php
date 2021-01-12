<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ProductServiceInterface; 
use App\Services\CategoryServiceInterface; 


class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
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
