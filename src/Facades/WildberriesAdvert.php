<?php

namespace KFilippovk\Wildberries\Facades;

/**
 * Custom config
 **/

class WildberriesAdvert extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wildberries_advert';
    }
}
