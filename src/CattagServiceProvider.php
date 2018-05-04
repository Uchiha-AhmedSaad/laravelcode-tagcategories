<?php

namespace TagCategories;

use Illuminate\Support\ServiceProvider;
use TagCategories\Categoriestag;

class CattagServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton('Categoriestag', function ($app) {
            return new Categoriestag();
        });
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

    }
}
