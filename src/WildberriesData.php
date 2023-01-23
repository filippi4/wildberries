<?php

namespace KFilippovk\Wildberries;

class WildberriesData
{
    public $data;
    public $status;

    public function __construct(WildberriesResponse $response)
    {
        $data = $response->toSimpleObject();
        $this->data = $data->data;
        $this->status = $data->status;
    }
}
