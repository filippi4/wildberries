<?php

namespace Filippi4\Wildberries;

class WildberriesAdvert extends WildberriesAdvertClient
{
    public function config(array $keys): WildberriesAdvert
    {
        $this->validateKeys($keys);

        $this->config = $keys;

        return $this;
    }

    /**
     * Получение РК
     * Получение количества рекламных кампаний (РК) поставщика
     *
     * @return array
     */
    public function getCount(): mixed
    {
        return (new WildberriesData($this->getResponse('adv/v0/count')))->data;
    }

    /**
     * Список РК
     * Получение списка РК поставщика
     *
     * @param int status 
     * @param int type
     * @param int limit
     * @param int offset
     * @param string order
     * @param string direction
     * @return array
     */
    public function getAdverts(
        int $status = null,
        int $type = null,
        int $limit = null,
        int $offset = null,
        string $order = null,
        string $direction = null,
    ): mixed {
        return (new WildberriesData($this->getResponse(
            'adv/v0/adverts',
            array_diff(compact('status', 'type', 'limit', 'offset', 'order', 'direction'), [''])
        )
        ))->data;
    }

    /**
     * Информация о РК
     * Получение информации об одной РК
     * 
     * @param int id
     * @return array
     */
    public function getAdvert(int $id): mixed
    {
        return (new WildberriesData($this->getResponse(
            'adv/v0/advert',
            compact('id')
        )
        ))->data;
    }

    /**
     * Список ставок
     * Получение списка РК поставщика
     *
     * @param int type
     * @param int param
     * @return array
     */
    public function getCpm(int $type, int $param): mixed
    {
        return (new WildberriesData($this->getResponse(
            'adv/v0/cpm',
            compact('type', 'param')
        )
        ))->data;
    }

    /**
     * Словарь значений параметра subjectId
     * Метод позволяет получить список значений параметра subjectId
     *
     * @param ?int $id
     * @return mixed
     */
    public function getParamsSubject(int $id = null): mixed
    {
        return (new WildberriesData($this->getResponse(
            'adv/v0/params/subject',
            array_diff(compact('id'), [''])
        )
        ))->data;
    }

    /**
     * Словарь значений параметра menuId
     * Метод позволяет получить список значений параметра menuId
     *
     * @param ?int $id
     * @return mixed
     */
    public function getParamsMenu(int $id = null): mixed
    {
        return (new WildberriesData($this->getResponse(
            'adv/v0/params/menu',
            array_diff(compact('id'), [''])
        )
        ))->data;
    }

    /**
     * Словарь значений параметра setId
     * Метод позволяет получить список значений параметра setId
     *
     * @param ?int $id
     * @return mixed
     */
    public function getParamsSet(int $id = null): mixed
    {
        return (new WildberriesData($this->getResponse(
            'adv/v0/params/set',
            array_diff(compact('id'), [''])
        )
        ))->data;
    }

    /**
     * Метод позволяет получать краткую статистику по автоматической РК.
     *
     * @param ?int $id
     * @return mixed
     */
    public function getAutoStat(int $id = null): mixed
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
     * @param ?int $id
     * @return mixed
     */
    public function getSeacatStat(int $id = null): mixed
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
}