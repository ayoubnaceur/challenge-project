<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ServiceInterface; 


class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ServiceInterface::class, ProductService::class);
        $this->app->bind(ServiceInterface::class, CategoryService::class);
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
