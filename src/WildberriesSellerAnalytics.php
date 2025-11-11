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
        $dateTo   = $dateTo->toDateString();
        $params   = compact('dateFrom', 'dateTo');
        return (new WildberriesData($this->getResponse('api/v1/paid_storage', $params)))->data;
    }

    public function getIncorrectAttachments(
        Carbon $dateFrom = null,
        Carbon $dateTo = null,
    ): mixed {
        $dateFrom = $dateFrom->toDateString();
        $dateTo   = $dateTo->toDateString();
        $params   = compact('dateFrom', 'dateTo');
        return (new WildberriesData($this->getResponse('api/v1/analytics/incorrect-attachments', $params)))->data;
    }

    public function createAcceptanceReport(
        Carbon $dateFrom = null,
        Carbon $dateTo = null
    ): mixed {
        $dateFrom = $dateFrom->toDateString();
        $dateTo   = $dateTo->toDateString();
        $params   = compact('dateFrom', 'dateTo');
        return (new WildberriesData($this->getResponse('api/v1/acceptance_report', $params)))->data;
    }

    public function getAcceptanceReportStatus(
        string $taskId
    ): mixed {
        return (new WildberriesData($this->getResponse("api/v1/acceptance_report/tasks/$taskId/status")))->data;
    }

    public function getAcceptanceReportData(
        string $taskId
    ): mixed {
        return (new WildberriesData($this->getResponse("api/v1/acceptance_report/tasks/$taskId/download")))->data;
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

    public function getContentHistoryNmid(array $nmIds, $selectedPeriod): mixed
    {
        $props = compact('nmIds', 'selectedPeriod');

        return (new WildberriesData(
            $this->postResponse('api/analytics/v3/sales-funnel/products/history', $props)
        ))->data;
    }


    /**
     * Проверка подключения
     *
     * @return mixed
     */
    public function ping(): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse('ping'),
            )
        )->data;
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
            'id'             => $id,
            'reportType'     => $reportType,
            "userReportName" => "Card report",
            "params"         => [
                "startDate"        => $startDate,
                "endDate"          => $endDate,
                "nmIDs"            => [],
                "subjectIDs"       => [],
                "brandNames"       => [],
                "tagIDs"           => [],
                "timezone"         => "Europe/Moscow",
                "aggregationLevel" => "day",
                "skipDeletedNms"   => false,
            ],
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
     *
     * @param string $startPeriod
     * @param string $endPeriod
     * @param string $topOrderBy
     * @param array $nmIds
     * @return mixed
     */
    public function getWbProductSearchTexts($nmIds, $startPeriod, $endPeriod, $topOrderBy): mixed
    {

        $props = [
            'nmIds'         => $nmIds,
            'currentPeriod' => [
                'start' => $startPeriod,
                'end'   => $endPeriod,
            ],
            'topOrderBy'    => $topOrderBy,
            "orderBy"       => [
                "field" => "avgPosition",
                "mode"  => "asc",
            ],
            "limit"         => 30,
        ];

        return (new WildberriesData($this->postResponse('api/v2/search-report/product/search-texts', $props)))->data;
    }

    /**
     *
     * @param string $startPeriod
     * @param string $endPeriod
     * @param int $nmId
     * @param array $searchTexts
     * @return mixed
     */
    public function getSearchProductOrders($nmId, $startPeriod, $endPeriod, $searchTexts): mixed
    {

        $props = [
            'nmId'        => $nmId,
            'period'      => [
                'start' => $startPeriod,
                'end'   => $endPeriod,
            ],
            "searchTexts" => $searchTexts,
        ];

        return (new WildberriesData($this->postResponse('api/v2/search-report/product/orders', $props)))->data;
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

    public function getSalesReportsByRegion(
        Carbon $dateFrom = null,
        Carbon $dateTo = null
    ) {
        $dateFrom = $dateFrom->toDateString();
        $dateTo   = $dateTo->toDateString();
        $params   = compact('dateFrom', 'dateTo');
        return (new WildberriesData($this->getResponse('api/v1/analytics/region-sale', $params)))->data;
    }

    public function getWbAntiFraudDetails(): mixed
    {

        return (new WildberriesData($this->getResponse('api/v1/analytics/antifraud-details')))->data;
    }

    /**
     * Retrieves the detailed report for the goods returns.
     *
     * @param string $dateFrom
     * @param string $dateTo
     * @return mixed
     */
    public function getGoodsReturn($dateFrom, $dateTo): mixed
    {
        $props = compact('dateFrom', 'dateTo');

        return (new WildberriesData($this->getResponse('api/v1/analytics/goods-return', $props)))->data;
    }

    /**
     * Retrieves the detailed report for the turnover dynamics.
     *
     * @param string $dateFrom
     * @param string $dateTo
     * @return mixed
     */
    public function getTurnoverDynamics($dateFrom, $dateTo): mixed
    {
        $props = compact('dateFrom', 'dateTo');

        return (new WildberriesData($this->getResponse('api/v1/turnover-dynamics/daily-dynamics', $props)))->data;
    }

    /**
     * Retrieves SellerBrands .
     *
     * @return mixed
     */
    public function getSellerBrands(): mixed
    {
        return (new WildberriesData($this->getResponse('api/v1/analytics/brand-share/brands')))->data;
    }

    /**
     * Retrieves ShadowedProducts .
     *
     * @return mixed
     */
    public function getShadowedProducts(string $sort, string $order): mixed
    {
        $params = compact('sort', 'order');
        return (new WildberriesData($this->getResponse('api/v1/analytics/banned-products/shadowed', $params)))->data;
    }

    /**
     * Retrieves BlockedProducts .
     *
     * @return mixed
     */
    public function getBlockedProducts(string $sort, string $order): mixed
    {
        $params = compact('sort', 'order');
        return (new WildberriesData($this->getResponse('api/v1/analytics/banned-products/blocked', $params)))->data;
    }

    /**
     * Retrieves SellerBrands .
     * @param string $brand
     * @param string $dateFrom
     * @param string $dateTo
     * @return mixed
     */
    public function getBrandParentSubjects($brand, $dateFrom, $dateTo): mixed
    {
        $props = compact('brand', 'dateFrom', 'dateTo');

        return (new WildberriesData($this->getResponse('api/v1/analytics/brand-share/parent-subjects', $props)))->data;
    }

    /**
     * Retrieves BrandShare .
     * @param int $parentId
     * @param string $brand
     * @param string $dateFrom
     * @param string $dateTo
     * @return mixed
     */
    public function getBrandShare(int $parentId, string $brand, $dateFrom, $dateTo): mixed
    {
        $props = compact('parentId', 'brand', 'dateFrom', 'dateTo');

        return (new WildberriesData($this->getResponse('api/v1/analytics/brand-share', $props)))->data;
    }

    /**
     *
     * @param string $startPeriod
     * @param string $endPeriod
     * @param int $nmId
     * @param string $orderByField
     * @param bool $includeOffice
     * @return mixed
     */
    public function getStocksProductsSizesReport(
        string $startPeriod,
        string $endPeriod,
        int $nmId,
        string $orderByField = 'saleRate',
        bool $includeOffice = false,
    ): mixed {
        $props = [
            'nmID'          => $nmId,
            'currentPeriod' => [
                'start' => $startPeriod,
                'end'   => $endPeriod,
            ],
            'stockType'     => '',
            'orderBy'       => [
                'field' => $orderByField,
                'mode'  => 'asc',
            ],
            'includeOffice' => $includeOffice,
        ];

        return (new WildberriesData($this->postResponse('api/v2/stocks-report/products/sizes', $props)))->data;
    }
}
