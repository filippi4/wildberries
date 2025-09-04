<?php
namespace Filippi4\Wildberries;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WildberriesClient
{
    private const STATISTICS_URL     = 'https://statistics-api.wildberries.ru/';
    private const NON_STATISTICS_URL = 'https://marketplace-api.wildberries.ru/';

    private const DEFAULT_HEADER = [
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json',
    ];

    private const DEFAULT_OPTIONS = [
        'headers' => self::DEFAULT_HEADER,
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
     * Create GET request to bank API
     *
     * @param string|null $uri
     * @param array $params
     * @param bool $is_stat
     * @return WildberriesResponse
     */
    protected function getResponse(string $uri = null, array $params = [], bool $is_stat = false): WildberriesResponse
    {
        $full_path = ($is_stat ? self::STATISTICS_URL : self::NON_STATISTICS_URL) . $uri;

        $options = self::DEFAULT_OPTIONS;

        $options['headers']['Authorization'] = $this->config['token_api'];

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
     * @return WildberriesResponse
     */
    protected function postResponse(string $uri = null, array $params = [], bool $is_stat = false): WildberriesResponse
    {
        $full_path = ($is_stat ? self::STATISTICS_URL : self::NON_STATISTICS_URL) . $uri;

        $options = self::DEFAULT_OPTIONS;

        $options['headers']['Authorization'] = $this->config['token_api'];

        if (count($params)) {
            $options['json'] = $params;
        }

        return WildberriesRequest::makeRequest($full_path, $options, 'post');
    }

    /**
     * Create GET request to bank API
     *
     * @param string|null $uri
     * @param array $params
     * @param bool $is_stat
     * @return mixed
     */
    protected function getResponseWithJson(string $uri = null, array $params = [], bool $is_stat = false): mixed
    {
        $full_path = ($is_stat ? self::STATISTICS_URL : self::NON_STATISTICS_URL) . $uri;

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => $this->config['token_api'],
        ])->withBody(json_encode($params, JSON_UNESCAPED_UNICODE))->get($full_path, ['timeout' => 100]);

        if ($response->status() > 399) {
            throw new Exception('Response status: ' . $response->status() . ' | Message: ' . json_encode($response->json(), JSON_UNESCAPED_UNICODE) . $response->body());
        }

        return $response->json();
    }

    protected function postResponseWithJson(string $uri = null, array $params = [], bool $is_stat = false): mixed
    {
        $full_path = ($is_stat ? self::STATISTICS_URL : self::NON_STATISTICS_URL) . $uri;

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => $this->config['token_api'],
        ])->withBody(json_encode($params, JSON_UNESCAPED_UNICODE))->post($full_path);

        if ($response->status() > 399) {
            throw new Exception('Response status: ' . $response->status() . ' | Message: ' . json_encode($response->json(), JSON_UNESCAPED_UNICODE) . $response->body());
        }
        return $response->json();
    }

}
