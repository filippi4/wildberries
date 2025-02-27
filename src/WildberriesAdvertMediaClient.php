<?php

namespace Filippi4\Wildberries;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WildberriesAdvertMediaClient
{
    private const ADVERT_URL = 'https://advert-media-api.wildberries.ru/';

    private const DEFAULT_HEADER = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

    private const DEFAULT_OPTIONS = [
        'headers' => self::DEFAULT_HEADER,
        'timeout' => 35,
        'connect_timeout' => 35,
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
            'token_api_adv' => 'required|string',
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
    protected function getResponse(string $uri = null, array $params = []): WildberriesResponse
    {
        $full_path = self::ADVERT_URL . $uri;
        $options = self::DEFAULT_OPTIONS;

        $options['headers']['Authorization'] = $this->config['token_api_adv'];

        if (count($params)) {
            $full_path .= '?' . http_build_query($params);
        }

        return WildberriesRequest::makeRequest($full_path, $options, 'get');
    }

    /**
     * Create POST request to bank API
     *
     * @param string|null $uri
     * @param array $params
     * @return mixed
     */
    protected function postResponse(string $uri = null, array $params = []): mixed
    {
        $full_path = self::ADVERT_URL . $uri;

        $options['headers']['Authorization'] = $this->config['token_api_adv'];

        $ch = curl_init($full_path);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Authorization:' . $this->config['token_api_adv']]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([$params], JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, JSON_UNESCAPED_UNICODE);
    }
}