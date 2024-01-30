<?php

namespace Filippi4\Wildberries;

use DateTime;
use Carbon\Carbon;

class WildberriesCommon extends WildberriesCommonClient
{
    public function config(array $keys): WildberriesCommon
    {
        $this->validateKeys($keys);

        $this->config = $keys;

        return $this;
    }

    /**
     * Получение информации по тарифам для коробов.
     *
     * @param string $date 
     * @return array
     */
    public function getInfo(string $date): array
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'api/v1/tariffs/box',
                    compact('date')
                )
            )
        )->data;
    }
}