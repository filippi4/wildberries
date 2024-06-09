<?php

namespace Filippi4\Wildberries;


use Carbon\Carbon;

class WildberriesSupplies extends WildberriesSuppliesClient
{
    public function config(array $keys): WildberriesSupplies
    {
        $this->validateKeys($keys);

        $this->config = $keys;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAcceptanceCoefficients(): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'api/v1/acceptance/coefficients'
                )
            )
        )->data;
    }

    /**
     * @return mixed
     * @param int $quantity
     * @param string $barcode
     */
    public function getAcceptanceOptions(int $quantity, string $barcode): mixed
    {
        $params = compact('quantity', 'barcode');
        return
            $this->postResponseWithJson(
                'api/v1/acceptance/options',
                $params
            );
    }
    /**
     * @return mixed
     */
    public function getWarehouses(): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'api/v1/warehouses'
                )
            )
        )->data;
    }
}