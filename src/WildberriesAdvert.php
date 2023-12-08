<?php

namespace Filippi4\Wildberries;

use Illuminate\Validation\ValidationException;

class WildberriesAdvert extends WildberriesAdvertClient
{
    /**
     * @throws ValidationException
     */
    public function config(array $keys): WildberriesAdvert
    {
        $this->validateKeys($keys);

        $this->config = $keys;

        return $this;
    }

    /**
     * Получение количества рекламных кампаний (РК) поставщика
     *
     * @return array
     */
    public function getCount(): mixed
    {
        return (new WildberriesData($this->getResponse('adv/v0/count')))->data;
    }

    /**
     * Получение списка РК поставщика
     *
     * @param ?int $status
     * @param ?int $type
     * @param ?string $order
     * @param ?string $direction
     * @return array
     */
    public function getAdverts(
        int $status = null,
        int $type = null,
        string $order = null,
        string $direction = null,
    ): mixed {
        return (
            new WildberriesData(
                $this->postGetAdvertsResponse(
                    'adv/v1/promotion/adverts',
                    array_diff(compact('status', 'type', 'order', 'direction'), [''])
                )
            )
        )->data;
    }

    /**
     * Получение кол-ва РК поставщика
     */
    public function getPromotionCount(): mixed {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v1/promotion/count'
                )
            )
        )->data;
    }

    /**
     * Получение информации об одной РК
     *
     * @param int $id
     * @return array
     */
    public function getAdvert(int $id): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v0/advert',
                    compact('id')
                )
            )
        )->data;
    }

    /**
     * Получение списка РК поставщика
     *
     * @param int $type
     * @param int $param
     * @return array
     */
    public function getCpm(int $type, int $param): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v0/cpm',
                    compact('type', 'param')
                )
            )
        )->data;
    }

    /**
     * Метод позволяет получить список значений параметра subjectId
     *
     * @param ?int $id
     * @return mixed
     */
    public function getParamsSubject(int $id = null): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v0/params/subject',
                    array_diff(compact('id'), [''])
                )
            )
        )->data;
    }

    /**
     * Метод позволяет получить список значений параметра menuId
     *
     * @param ?int $id
     * @return mixed
     */
    public function getParamsMenu(int $id = null): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v0/params/menu',
                    array_diff(compact('id'), [''])
                )
            )
        )->data;
    }

    /**
     * Метод позволяет получить список значений параметра setId
     *
     * @param ?int $id
     * @return mixed
     */
    public function getParamsSet(int $id = null): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v0/params/set',
                    array_diff(compact('id'), [''])
                )
            )
        )->data;
    }

    /**
     * Метод позволяет получать статистику поисковой кампании по ключевым фразам
     *
     * @param int $id
     * @return mixed
     */
    public function getStatWords(int $id): mixed
    {
        return (new WildberriesData($this->getResponse('adv/v1/stat/words', compact('id'))))->data;
    }

    /**
     * Метод позволяет получать расширенную статистку кампании, разделенную по дням, номенклатурам
     * и платформам (сайт, андроид, IOS)
     *
     * @param int $id
     * @return mixed
     */
    public function getFullstat(int $id): mixed
    {
        return (new WildberriesData($this->getResponse('adv/v1/fullstat', compact('id'))))->data;
    }

    /**
     * Метод позволяет получать краткую статистику по автоматической РК.
     *
     * @param int $id
     * @return mixed
     */
    public function getAutoStat(int $id): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v1/auto/stat',
                    array_diff(compact('id'), [''])
                )
            )
        )->data;
    }

    /**
     * Метод позволяет получать краткую статистику по РК Поиск + Каталог.
     *
     * @param int $id
     * @return mixed
     */
    public function getSeacatStat(int $id): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v1/seacat/stat',
                    array_diff(compact('id'), [''])
                )
            )
        )->data;
    }

    /**
     * Метод позволяет получать историю затрат
     *
     * @param string $from
     * @param string $to
     * @return mixed
     */
    public function getCostHistory(string $from, string $to): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v1/upd',
                    array_diff(compact('from', 'to'), [''])
                )
            )
        )->data;
    }

    /**
     * Метод позволяет получать историю пополнения счета
     *
     * @param string $from
     * @param string $to
     * @return mixed
     */

    public function getPaymentsHistory(string $from, string $to): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v1/payments',
                    array_diff(compact('from', 'to'), [''])
                )
            )
        )->data;
    }
}