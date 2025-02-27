<?php

namespace Filippi4\Wildberries\Facades;

use Illuminate\Support\Facades\Facade;

class WildberriesDocuments extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wildberries_documents';
    }
}