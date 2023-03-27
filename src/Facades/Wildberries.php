<?php

namespace Filippi4\Wildberries\Facades;

use Illuminate\Support\Facades\Facade;
use DateTime;

/**
 * Custom config
 * @method static Wildberries \Filippi4\Wildberries\Wildberries config($keys)
 * Цены
 * @method static array getInfo(int $quantity = 0)
 * Контент / Просмотр
 * @method static mixed getCardsErrorList()
 * Контент / Конфигуратор
 * @method static mixed getObjectAll()
 * @method static mixed getObjectParentAll()
 * @method static mixed getObjectCharacteristicsListFilter()
 * @method static mixed getObjectCharacteristicsObjectName(string $objectName)
 * @method static mixed getDirectoryColors()
 * @method static mixed getDirectoryKinds()
 * @method static mixed getDirectoryCountries()
 * @method static mixed getDirectoryCollections()
 * @method static mixed getDirectorySeasons()
 * @method static mixed getDirectoryContents()
 * @method static mixed getDirectoryConsists()
 * @method static mixed getDirectoryBrands()
 * @method static mixed getDirectoryTnved()
 * Marketplace
 * @method static mixed getSupplies()
 * @method static mixed getSuppliesIdBarcode(string $id, string $type)
 * @method static mixed getSuppliesIdOrders(string $id)
 * @method static mixed getStocks(int $skip, int $take, $search = null)
 * @method static array getWarehouses()
 * @method static mixed getOrders(int $skip, int $take, DateTime $date_start, DateTime $date_end = null, int $status = null, int $id = null, bool $is_UTC = false)
 * Статистика
 * @method static array getSupplierIncomes(DateTime $dateFrom, bool $is_UTC = false)
 * @method static array getSupplierStocks(DateTime $dateFrom, bool $is_UTC = false)
 * @method static array getSupplierOrders(DateTime $dateFrom, bool $is_UTC = false) *
 * @method static array getSupplierSales(DateTime $dateFrom, int $flag = 0, bool $is_UTC = false)
 * @method static array getSupplierReportDetailByPeriod(DateTime $dateFrom, DateTime $dateTo, int $limit = 0, int $rrdid = 0, bool $is_UTC = false)
 * @method static array getSupplierExciseGoods(DateTime $dateFrom, bool $is_UTC = false)
 **/

class Wildberries extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wildberries';
    }
}
