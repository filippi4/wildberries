<?php

namespace Filippi4\Wildberries;

use Illuminate\Support\ServiceProvider;

class WildberriesFeedbacksServiceProvider extends ServiceProvider
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
        $this->app->bind('wildberries_feedbacks', function () {
            return new WildberriesFeedbacks();
        });
    }
}
