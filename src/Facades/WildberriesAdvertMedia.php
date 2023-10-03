<?php

namespace Filippi4\Wildberries\Facades;

/**
 * Custom config
 * @method static WildberriesAdvert \Filippi4\Wildberries\WildberriesAdvertMedia config($keys)
 * ...
 **/

class WildberriesAdvertMedia extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wildberries_advert_media';
    }
}
