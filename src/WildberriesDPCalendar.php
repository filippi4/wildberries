<?php

namespace Filippi4\Wildberries;

use DateTime;
use Carbon\Carbon;

class WildberriesDPCalendar extends WildberriesDPCalendarClient
{
    public function config(array $keys): WildberriesDPCalendar
    {
        $this->validateKeys($keys);

        $this->config = $keys;

        return $this;
    }

    /**
     * @param string $startDateTime
     * @param string $endDateTime
     * @param boolean $allPromo
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function getPromotions(
        string $startDateTime,
        string $endDateTime,
        bool $allPromo,
        int $limit,
        int $offset = 0
    ): mixed {
        $params = compact('startDateTime', 'endDateTime', 'allPromo', 'limit', 'offset');
        return (new WildberriesData($this->getResponse('api/v1/calendar/promotions', $params)))->data;
    }

    /**
     * @param string $promotionIDs
     * @return mixed
     */
    public function getPromotionsDetails(
        string $promotionIDs,
    ): mixed {
        $params = compact('promotionIDs');
        return (new WildberriesData($this->getResponse('api/v1/calendar/promotions/details', $params)))->data;
    }

    /**
     * @param int $promotionID
     * @param bool $inAction
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function getPromotionsNomenclatures(
        string $promotionID,
        bool $inAction,
        int $limit,
        int $offset = 0
    ): mixed {
        $params = compact('promotionID', 'inAction', 'limit', 'offset');
        return (new WildberriesData($this->getResponse('api/v1/calendar/promotions/nomenclatures', $params)))->data;
    }

}