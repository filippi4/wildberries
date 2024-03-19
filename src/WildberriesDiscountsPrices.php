<?php

namespace Filippi4\Wildberries;

use DateTime;
use Carbon\Carbon;

class WildberriesDiscountsPrices extends WildberriesDiscountsPricesClient
{
    public function config(array $keys): WildberriesDiscountsPrices
    {
        $this->validateKeys($keys);

        $this->config = $keys;

        return $this;
    }


    /**
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function getPrices(
        int $limit,
        int $offset
    ): mixed {
        $params = compact('limit', 'offset');
        return (new WildberriesData($this->getResponse('api/v2/list/goods/filter', $params)))->data;
    }
}