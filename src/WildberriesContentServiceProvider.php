<?php

namespace Filippi4\Wildberries;

use Illuminate\Support\ServiceProvider;

class WildberriesContentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('wildberries_content', function () {
            return new WildberriesContent();
        });
    }
}