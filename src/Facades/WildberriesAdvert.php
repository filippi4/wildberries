<?php

namespace KFilippovk\Wildberries\Facades;

/**
 * Custom config
 * @method static WildberriesAdvert \KFilippovk\Wildberries\WildberriesAdvert config($keys)
 * ...
 **/

class WildberriesAdvert extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wildberries_advert';
    }
}
