<?php

namespace larvelcode\tagcategories;

use Illuminate\Support\ServiceProvider;
use larvelcode\tagcategories\Categoriestag;

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
