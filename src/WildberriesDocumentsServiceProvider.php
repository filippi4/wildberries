<?php

namespace Filippi4\Wildberries\Providers;

use Illuminate\Support\ServiceProvider;
use Filippi4\Wildberries\WildberriesDocumentsClient;

class WildberriesDocumentsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('wildberries_documents', function () {
            return new WildberriesDocumentsClient();
        });
    }
}
