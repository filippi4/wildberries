<?php


namespace Filippovk997\WildberriesAdvert;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Filippovk997\WildberriesAdvert\Exceptions\WildberriesHttpException;
use Throwable;

class WildberriesRequest
{
    /**
     * @var null|WildberriesRequest
     */
    private static ?WildberriesRequest $instance = null;
    private Client $httpClient;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    private static function getInstance(): WildberriesRequest
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from WildberriesRequest::getInstance() instead
     */
    private function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * Create POST/GET request to WB API
     *
     * @param string $url
     * @param array $options
     * @param string $method
     * @return WildberriesResponse
     * @throws WildberriesHttpException
     */

    public static function makeRequest(string $url, array $options, string $method = 'get'): WildberriesResponse
    {
        return new WildberriesResponse(
            $method === 'get'
                ? self::runGetRequest($url, $options)
                : self::runPostRequest($url, $options)
        );
    }

    /**
     * Create GET request to WB API
     *
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws WildberriesHttpException
     */
    private static function runGetRequest(string $url, array $options): ResponseInterface
    {
        try {
            return self::getInstance()->getHttpClient()->get($url, $options);
        }
        catch (Throwable $exception) {
            throw new WildberriesHttpException($exception);
        }
    }

    /**
     * Create POST request to WB API
     *
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws WildberriesHttpException
     */
    private static function runPostRequest(string $url, array $options): ResponseInterface
    {
        try {
            return self::getInstance()->getHttpClient()->post($url, $options);
        } catch (Throwable $exception) {
            throw new WildberriesHttpException($exception);
        }
    }

    private function getHttpClient(): Client
    {
        return $this->httpClient;
    }

}
