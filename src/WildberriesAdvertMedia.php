<?php

namespace Filippi4\Wildberries;

use Illuminate\Validation\ValidationException;

class WildberriesAdvertMedia extends WildberriesAdvertMediaClient
{
    /**
     * @throws ValidationException
     */
    public function config(array $keys): WildberriesAdvertMedia
    {
        $this->validateKeys($keys);

        $this->config = $keys;

        return $this;
    }

    /**
     * Метод позволяет получить список медиакампаний продавца.
     *
     * @param int $limit
     * @param int $offset
     * @param string $order
     * @param string $direction
     * @return mixed
     */
    public function getMediaList(int $limit, int $offset, string $order, string $direction): mixed
    {
        return (
            new WildberriesData(
                $this->getResponse(
                    'adv/v1/adverts',
                    array_diff(compact('limit', 'offset', 'order', 'direction'), [''])
                )
            )
        )->data;
    }
}
