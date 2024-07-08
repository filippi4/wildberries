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
        return (new WildberriesData($this->getResponse('api/v1/paid_storage', $params)))->data;
    }

    public function getIncorrectAttachments(
        Carbon $dateFrom = null,
        Carbon $dateTo = null,
    ): mixed {
        $dateFrom = $dateFrom->toDateString();
        $dateTo = $dateTo->toDateString();
        $params = compact('dateFrom', 'dateTo');
        return (new WildberriesData($this->getResponse('api/v1/analytics/incorrect-attachments', $params)))->data;
    }


    public function getAcceptanceReports(
        Carbon $dateFrom = null,
        Carbon $dateTo = null,
    ): mixed {
        $dateFrom = $dateFrom->toDateString();
        $dateTo = $dateTo->toDateString();
        $params = compact('dateFrom', 'dateTo');
        return (new WildberriesData($this->getResponse('api/v1/analytics/acceptance-report', $params)))->data;
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


    public function getContentHistoryNmid(array $nmIDs, $period): mixed
    {
        $props = compact('nmIDs', 'period');

        return (new WildberriesData($this->postResponse('api/v2/nm-report/detail/history', $props)))->data;
    }

    /**
     * Retrieves the detailed report for the specified nmIDs, period, and page.
     *
     * @param array $nmIDs The array of nmIDs to retrieve the report for.
     * @param mixed $period The period for which the report is requested.
     * @param mixed $page The page number for pagination.
     * @return mixed The data containing the detailed report.
     */
    public function getNmReportDetail(array $nmIDs, $period, $page): mixed
    {
        $props = compact('nmIDs', 'period', 'page');

        return (new WildberriesData($this->postResponse('api/v2/nm-report/detail', $props)))->data;
    }

    /**
     * Creates a Djem report for a given NM ID, report type, start date, and end date.
     *
     * @param string $id The ID of the NM.
     * @param string $reportType The type of report.
     * @param string $startDate The start date of the report.
     * @param string $endDate The end date of the report.
     * @return mixed The response from the API call.
     */
    public function createNmDjemReport(string $id, string $reportType, string $startDate, string $endDate): mixed
    {
        $params = [
            'id' => $id,
            'reportType' => $reportType,
            "userReportName" => "Card report",
            "params" => [
                "startDate" => $startDate,
                "endDate" => $endDate,
                "nmIDs" => [],
                "subjectIDs" => [],
                "brandNames" => [],
                "tagIDs" => [],
                "timezone" => "Europe/Moscow",
                "aggregationLevel" => "day",
                "skipDeletedNms" => false
            ]
        ];

        return $this->postResponseWithJson('api/v2/nm-report/downloads', $params);
    }


    /**
     * Retrieves the status of the Djem report for the given ID.
     *
     * @param string $id The ID of the Djem report.
     * @return mixed The data containing the Djem report status.
     */
    public function getNmDjemReportStatus(string $id): mixed
    {
        $props = ['filter' => ['downloadIds' => [$id]]];

        return (new WildberriesData($this->getResponse('api/v2/nm-report/downloads', $props)))->data;
    }

    /**
     * Retrieves the Djem report for the given ID.
     *
     * @param string $id The ID of the Djem report.
     * @return mixed The Djem report file.
     */
    public function getNmDjemReport(string $id): mixed
    {
        return $this->getFile('api/v2/nm-report/downloads/file/' . $id);
    }


    public function getStorageCoefficient($date): mixed
    {
        $props = compact('date');

        return (new WildberriesData($this->getResponse('api/v1/analytics/storage-coefficient', $props)))->data;
    }
}