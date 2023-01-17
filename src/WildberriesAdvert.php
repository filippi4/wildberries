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
    public function getCount(): array
    {
        return (new WildberriesData($this->getResponse('adv/v0/count')))->data;
    }
}
