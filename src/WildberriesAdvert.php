<?php

namespace Filippovk997\WildberriesAdvert;

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
     *
     * @return array
     */
    public function getCount(): mixed
    {
        return (new WildberriesData($this->getResponse('adv/v0/count')))->data;
    }

    /**
     * Список РК
     *
     * @return array
     */
    public function getAdverts(
        int $status = null,
        int $type = null,
        int $limit = null,
        int $offset = null,
        string $order = null,
        string $direction = null,
    ): mixed
    {
        return (new WildberriesData($this->getResponse(
            'adv/v0/adverts',
            array_diff(compact('status', 'type', 'limit', 'offset', 'order', 'direction'), [''])
        )))->data;
    }

    /**
     * Информация о РК
     *
     * @return array
     */
    public function getAdvert(int $id): mixed
    {
        return (new WildberriesData($this->getResponse(
            'adv/v0/advert',
            compact('id')
        )))->data;
    }
}
