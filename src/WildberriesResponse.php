<?php


namespace Filippovk997\WildberriesAdvert;

use Psr\Http\Message\ResponseInterface;

class WildberriesResponse
{
    protected ResponseInterface $response;
    /**
     * @var false|string
     */
    private $output = [];


    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->parseResponse();
    }

    /**
     * Parse response
     */
    private function parseResponse(): void
    {
        $status = $this->response ? $this->response->getStatusCode() : 500;
        $response = $this->response ? $this->response->getBody()->getContents() : null;

        $this->output = [
            'status' => $status,
            'data' => json_decode($response, true),
        ];
    }

    public function toSimpleObject()
    {
        return json_decode(json_encode($this->output), false);
    }

    public function json()
    {
        return json_encode($this->output);
    }

    public function toArray()
    {
        return $this->output;
    }
}
