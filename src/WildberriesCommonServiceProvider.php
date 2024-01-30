<?php

namespace Filippi4\Wildberries;

use Illuminate\Support\ServiceProvider;

class WildberriesCommonServiceProvider extends ServiceProvider
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
        $this->app->bind('wildberries_common', function () {
            return new Wildberries();
        });
    }
}