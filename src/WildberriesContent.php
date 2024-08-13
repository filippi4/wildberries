<?php

namespace Filippi4\Wildberries;

use DateTime;
use Carbon\Carbon;

class WildberriesContent extends WildberriesContentClient
{
    public function config(array $keys): WildberriesContent
    {
        $this->validateKeys($keys);

        $this->config = $keys;

        return $this;
    }



    /** MBA-6 ~5m
     * Метод позволяет получить список НМ и список ошибок которые произошли во время создания КТ.
     * ВАЖНО: Для того чтобы убрать НМ из ошибочных, надо повторно сделать запрос с исправленными ошибками на создание КТ.
     *
     * @return mixed
     */
    public function getCardsErrorList(): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/cards/error/list'
                )
            )
        )->data;
    }

    /** MBA-9 ~5m
     * С помощью данного метода можно получить список всех родительских категорий товаров.
     *
     * @return mixed
     */
    public function getObjectParentAll(): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/object/parent/all'
                )
            )
        )->data;
    }

    /** MBA-10 ~ 5m
     * С помощью данного метода можно получить список характеристик которые можно или нужно заполнить при создании КТ в подкатегории определенной родительской категории.
     *
     * @param string|null $name Поиск по родительской категории
     *                          Example: name=Косухи
     * @return mixed
     */
    public function getObjectCharacteristicsListFilter(string $name = null): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/object/characteristics/list/filter',
                    array_diff(compact('name', ), [''])
                )
            )
        )->data;
    }

    /** MBA-11 ~5m
     * С помощью данного метода можно получить список характеристик которые можно или нужно заполнить при создании КТ для определенной категории товаров.
     *
     * @param string $objectName Поиск по наименованию категории
     *                           Example: Носки
     * @return mixed
     */
    public function getObjectCharacteristicsObjectName(string $objectName): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/object/characteristics/' . $objectName,
                    [
                        'objectName' => $objectName,
                    ]
                )
            )
        )->data;
    }

    /** MBA-12 ~5m
     * Получение значения характеристики цвет.
     *
     * @return mixed
     */
    public function getDirectoryColors(): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/directory/colors'
                )
            )
        )->data;
    }

    /** MBA-13 ~5m
     * Получение значения характеристики пол.
     *
     * @return mixed
     */
    public function getDirectoryKinds(): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/directory/kinds'
                )
            )
        )->data;
    }

    /** MBA-14 ~5m
     * Получение значения характеристики Страна Производства.
     *
     * @return mixed
     */
    public function getDirectoryCountries(): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/directory/countries'
                )
            )
        )->data;
    }

    /** MBA-15 ~5m
     * Получение значения характеристики Коллекции.
     *
     * @param int|null $top Количество запрашиваемых значений (максимум 5000)
     *                      Example: top=1
     * @param string|null $pattern Поиск по наименованию значения характеристики
     *                    Example: pattern=зим
     * @return mixed
     */
    public function getDirectoryCollections(int $top = null, string $pattern = null): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/directory/collections',
                    array_diff(compact('top', 'pattern'), [''])
                )
            )
        )->data;
    }

    /** MBA-16 ~5m
     * Получение значения характеристики Сезон.
     *
     * @return mixed
     */
    public function getDirectorySeasons(): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/directory/seasons'
                )
            )
        )->data;
    }

    /** MBA-17 ~5m
     * Получение значения характеристики Комплектация.
     *
     * @param int|null $top Количество запрашиваемых значений (максимум 5000)
     *                      Example: top=1
     * @param string|null $pattern Поиск по наименованию значения характеристики
     *                             Example: pattern=USB
     * @return mixed
     */
    public function getDirectoryContents(int $top = null, string $pattern = null): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/directory/contents',
                    array_diff(compact('top', 'pattern'), [''])
                )
            )
        )->data;
    }

    /** MBA-18 ~5m
     * Получение значения характеристики Состав.
     *
     * @param int|null $top Количество запрашиваемых значений (максимум 5000)
     *                      Example: top=1
     * @param string|null $pattern Поиск по наименованию значения характеристики
     *                             Example: pattern=хлопок
     * @return mixed
     */
    public function getDirectoryConsists(int $top = null, string $pattern = null): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/directory/consists',
                    array_diff(compact('top', 'pattern'), [''])
                )
            )
        )->data;
    }

    /** MBA-19 ~5m
     * Получение значения характеристики Бренд.
     *
     * @param int|null $top Количество запрашиваемых значений (максимум 5000)
     *                      Example: top=1
     * @param string|null $pattern Поиск по наименованию значения характеристики
     *                             Example: pattern=USB
     * @return mixed
     */
    public function getDirectoryBrands(int $top = null, string $pattern = null): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/directory/brands',
                    array_diff(compact('top', 'pattern'), [''])
                )
            )
        )->data;
    }

    /** MBA-20 ~5m
     * С помощью данного метода можно получить список ТНВЭД кодов по имени категории и фильтру по тнвэд коду.
     *
     * @param string|null $objectName Поиск по наименованию категории
     *                    Example: objectName=Блузки
     * @param string|null $tnvedsLike Поиск по коду ТНВЭД
     *                                Example: tnvedsLike=4203100001
     * @return mixed
     */
    public function getDirectoryTnved(string $objectName = null, string $tnvedsLike = null): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'content/v1/directory/tnved',
                    array_diff(compact('objectName', 'tnvedsLike'))
                )
            )
        )->data;
    }


    /**
     * @param int $limit
     * @param string $updatedAt
     * @param int $nmID
     * @return mixed
     */
    public function getCardsCursorList(int $limit, string $updatedAt = '', int $nmID = null): mixed
    {
        if ($nmID) {
            $props = [
                'settings' => [
                    'cursor' => [
                        'limit' => $limit,
                        'updatedAt' => $updatedAt,
                        'nmID' => $nmID
                    ],
                    "filter" => [
                        "withPhoto" => -1
                    ]
                ]
            ];
        } else {
            $props = [
                'settings' => [
                    'cursor' => [
                        'limit' => $limit,
                    ],
                    "filter" => [
                        "withPhoto" => -1
                    ]
                ]
            ];
        }
        return $this->postResponseWithJson('content/v2/get/cards/list', $props);
    }
}