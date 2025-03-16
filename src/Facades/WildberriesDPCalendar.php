<?php

namespace Filippi4\Wildberries\Facades;

use Illuminate\Support\Facades\Facade;



class WildberriesDPCalendar extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wildberries_dp_calendar';
    }
}