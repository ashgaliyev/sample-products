<?php

namespace AndreyAsh\SampleProducts;

use Illuminate\Support\ServiceProvider;

class SampleProductsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'sample-products');

        $this->loadMigrationsFrom(realpath(__DIR__.'/migrations'));

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('AndreyAsh\SampleProducts\SampleProductsController');
    }
}
