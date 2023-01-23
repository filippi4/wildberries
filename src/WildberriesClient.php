<?php

namespace Filippovk997\Wildberries;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WildberriesClient
{
    private const STATISTICS_URL = 'https://statistics-api.wildberries.ru/';
    private const NON_STATISTICS_URL = 'https://suppliers-api.wildberries.ru/';
    // @TODO: удалить после перехода на новые ключи WB (стандартный и статистика)
    private const OLD_STATISTICS_URL = 'https://suppliers-stats.wildberries.ru/';

    private const DEFAULT_HEADER = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

    private const DEFAULT_OPTIONS = [
        'headers' => self::DEFAULT_HEADER
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
            'token_api_stat' => 'required|string',
            // @TODO: удалить после перехода на новые ключи WB (стандартный и статистика)
            'token_stat_x64' => 'string',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->messages()->getMessages());
        }
    }

    /**
     * Create GET request to bank API
     *
     * @param string|null $uri
     * @param array $params
     * @param bool $is_stat
     * @return WildberriesResponse
     */
    protected function getResponse(string $uri = null, array $params = [], bool $is_stat = false): WildberriesResponse
    {
        if ($this->config['token_api_stat'] !== 'NULL') {
            // @TODO: оставить после перехода на новые ключи WB (стандартный и статистика)
            $full_path = ($is_stat ? self::STATISTICS_URL : self::NON_STATISTICS_URL) . $uri;
            $options = self::DEFAULT_OPTIONS;

            $options['headers']['Authorization'] = $is_stat ? $this->config['token_api_stat'] : $this->config['token_api'];
        } else {
            // @TODO: удалить после перехода на новые ключи WB (стандартный и статистика)
            $full_path = ($is_stat ? self::OLD_STATISTICS_URL : self::NON_STATISTICS_URL) . $uri;
            $options = self::DEFAULT_OPTIONS;

            if ($is_stat) {
                $params['key'] = $this->config['token_stat_x64'];
            } else {
                $options['headers']['Authorization'] = $this->config['token_api'];
            }
        }
        if ($is_stat) {
            
        } else {
            $options['headers']['Authorization'] = $this->config['token_api'];
        }

        if (count($params)) {
            $full_path .= '?' . http_build_query($params);
        }

        return WildberriesRequest::makeRequest($full_path, $options, 'get');
    }
}
