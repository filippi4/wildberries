<?php

namespace Filippovk997\WildberriesAdvert;

use Illuminate\Support\ServiceProvider;

class WildberriesAdvertServiceProvider extends ServiceProvider
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
        $this->app->bind('wildberries_advert', function () {
            return new WildberriesAdvert();
        });
    }
}
