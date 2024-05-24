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
     * @return mixed
     */
    public function getTariffsBox(string $date): mixed
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

    /**
     * Получение информации по тарифам для монопалет.
     *
     * @param string $date
     * @return mixed
     */
    public function getTariffsPallet(string $date): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'api/v1/tariffs/pallet',
                    compact('date')
                )
            )
        )->data;
    }

    /**
     * Получение информации по тарифам для монопалет.
     *
     * @param string $date
     * @return mixed
     */
    public function getTariffsReturn(string $date): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'api/v1/tariffs/return',
                    compact('date')
                )
            )
        )->data;
    }
    /**
     * Получение информации по тарифам для монопалет.
     *
     * @param string $locale
     * @return mixed
     */
    public function getTariffsCommissions(string $locale = 'ru'): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'api/v1/tariffs/commission',
                    compact('locale')
                )
            )
        )->data;
    }
}