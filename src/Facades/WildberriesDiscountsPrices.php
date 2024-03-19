<?php

namespace Filippi4\Wildberries\Facades;

use Illuminate\Support\Facades\Facade;
use DateTime;


class WildberriesDiscountsPrices extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wildberries_discounts_prices';
    }
}