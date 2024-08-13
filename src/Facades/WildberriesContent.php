<?php

namespace Filippi4\Wildberries\Facades;

use Illuminate\Support\Facades\Facade;



class WildberriesContent extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wildberries_content';
    }
}