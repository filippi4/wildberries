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

    /**
     * @param array $dates
     * @param array $statusIDs
     * @return mixed
     */
    public function getSuppliesList(array $dates = [], array $statusIDs = []): mixed
    {
        $params = [];

        if (!empty($dates)) {
            $params['dates'] = $dates;
        }

        if (!empty($statusIDs)) {
            $params['statusIDs'] = $statusIDs;
        }

        return (
        new WildberriesData(
            $this->postResponse(
                'api/v1/supplies',
                $params
            )
        )
        )->data;
    }

    /**
     * @param int $supplyId
     * @param int $limit
     * @param int $offset
     * @param bool $isPreorderID
     * @return mixed
     */
    public function getSupplyGoods(int $supplyId, int $limit = 100, int $offset = 0, bool $isPreorderID = false): mixed
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
            'isPreorderID' => $isPreorderID,
        ];

        return (
        new WildberriesData(
            $this->getResponse(
                "api/v1/supplies/{$supplyId}/goods",
                $params
            )
        )
        )->data;
    }
}