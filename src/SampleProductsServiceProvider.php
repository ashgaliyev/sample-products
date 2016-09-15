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

        $this->publishes([
            realpath(__DIR__.'/migrations') => $this->app->databasePath().'/migrations'
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('AndreyAsh\SampleProducts\SampleProductsController');
    }
}
