<?php

namespace Filippi4\Wildberries;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WildberriesDocumentsClient
{
    private const DOCUMENTS_URL = 'https://documents-api.wildberries.ru/';

    private const DEFAULT_HEADER = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

    private const DEFAULT_OPTIONS = [
        'headers' => self::DEFAULT_HEADER
    ];

    protected $config;

    public function __construct()
    {
        $this->config = null;
    }

    /**
     * Проверяем, что присутствует нужный ключ для Document API.
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
     * Устанавливаем конфигурацию (например, токен).
     */
    public function config(array $keys): self
    {
        $this->validateKeys($keys);
        $this->config = $keys;
        return $this;
    }

    /**
     * Базовый метод для GET‑запросов к Document API.
     */
    protected function getRequest(string $uri = '', array $params = []): WildberriesResponse
    {
        $fullPath = self::DOCUMENTS_URL . ltrim($uri, '/');
        $options = self::DEFAULT_OPTIONS;
        $options['headers']['Authorization'] = $this->config['token_api'];

        if (!empty($params)) {
            $fullPath .= '?' . http_build_query($params);
        }

        return WildberriesRequest::makeRequest($fullPath, $options, 'get');
    }

    /**
     * Базовый метод для POST‑запросов к Document API.
     */
    protected function postRequest(string $uri = '', array $params = []): WildberriesResponse
    {
        $fullPath = self::DOCUMENTS_URL . ltrim($uri, '/');
        $options = self::DEFAULT_OPTIONS;
        $options['headers']['Authorization'] = $this->config['token_api'];

        if (!empty($params)) {
            $options['json'] = $params;
        }

        return WildberriesRequest::makeRequest($fullPath, $options, 'post');
    }
}
