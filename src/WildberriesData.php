<?php

namespace Filippovk997\Wildberries;


use stdClass;

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
