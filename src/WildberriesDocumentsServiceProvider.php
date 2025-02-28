<?php

namespace Filippi4\Wildberries;

use Illuminate\Support\ServiceProvider;

class WildberriesDocumentsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('wildberries_documents', function () {
            return new WildberriesDocuments();
        });
    }
}
