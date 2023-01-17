<?php

namespace Filippovk997\WildberriesAdvert;


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
