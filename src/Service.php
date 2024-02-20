<?php

namespace yidas\googleMaps;

/**
 * Google Maps Abstract Service
 *
 * @author Nick Tsai <myintaer@gmail.com>
 * @since 1.0.0
 */
abstract class Service
{
    /**
     * Define by each service
     *
     * @var string
     */
    public const API_PATH = '';

    /**
     * Request Handler
     *
     * @param \yidas\googleMaps\Client $client
     * @param string $apiPath
     * @param array $params
     * @param string $method HTTP request method
     * @param string|null $body
     *
     * @return mixed|array Formated result
     */
    protected static function requestHandler(Client $client, $apiPath, $params, $method = 'GET', $body = null)
    {
        if ($body === null && isset($params['body'])) {
            $body = $params['body'];
            unset($params['body']);
        }

        $response = $client->request($apiPath, $params, $method, $body);
        $result = $response->getBody()->getContents();
        $result = json_decode($result, true);

        // Error Handler
        if ($response->getStatusCode() !== 200) {
            return $result;
        }

        // Error message Checker (200 situation form Google Maps API)
        if (isset($result['error_message'])) {
            return $result;
        }

        // `results` parsing from Google Maps API, while pass parsing on error
        return $result['results'] ?? $result;
    }
}
