<?php

namespace Filippi4\Wildberries;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use Exception;

class WildberriesReturnsClient
{
    private const RETURNS_URL = 'https://returns-api.wildberries.ru/';

    private const DEFAULT_HEADER = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

    private const DEFAULT_OPTIONS = [
        'headers' => self::DEFAULT_HEADER,
        'timeout' => 70,
        'connect_timeout' => 70,
    ];

    protected $config;

    /**
     * ClientHint constructor.
     */
    public function __construct()
    {
        $this->config = null;
    }

    /**
     * @throws ValidationException
     */
    protected function validateKeys(array $keys): void
    {
        $validator = Validator::make($keys, [
            'token_api' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->messages()->getMessages());
        }
    }

    /**
     * Create GET request to API
     *
     * @param string|null $uri
     * @param array $params
     * @return WildberriesResponse
     */
    protected function getResponse(string $uri = null, array $params = []): WildberriesResponse
    {
        $full_path = self::RETURNS_URL . $uri;
        $options = self::DEFAULT_OPTIONS;

        $options['headers']['Authorization'] = $this->config['token_api'];

        if (count($params)) {
            $full_path .= '?' . http_build_query($params);
        }

        return WildberriesRequest::makeRequest($full_path, $options, 'get');
    }
}