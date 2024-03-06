<?php

namespace Filippi4\Wildberries;


use Carbon\Carbon;

class WildberriesSellerAnalytics extends WildberriesSellerAnalyticsClient
{
    public function config(array $keys): WildberriesSellerAnalytics
    {
        $this->validateKeys($keys);

        $this->config = $keys;

        return $this;
    }

    public function getPaidStorages(
        Carbon $dateFrom = null,
        Carbon $dateTo = null,
        string $type = 'paid_storage'
    ): mixed {
        $dateFrom = $dateFrom->toDateString();
        $dateTo = $dateTo->toDateString();
        $params = compact('dateFrom', 'dateTo');
        $params = compact('type', 'params');
        return $this->getResponseWithJson('api/v1/paid_storage', $params);
    }


    public function getReportStatus(
        string $id
    ): mixed {

        return $this->getResponseWithJson('api/v1/paid_storage/tasks/' . $id . '/status', []);
    }

    public function getReport(
        string $id
    ): mixed {
        return $this->getResponseWithJson('api/v1/paid_storage/tasks/' . $id . '/download', []);
    }
}