<?php

namespace Filippovk997\WildberriesAdvert\Facades;

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
