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
}