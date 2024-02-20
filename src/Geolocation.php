<?php

namespace yidas\googleMaps;

/**
 * Directions Service
 *
 * @author Nick Tsai <myintaer@gmail.com>
 * @since 1.0.0
 * @see https://developers.google.com/maps/documentation/geolocation/
 */
class Geolocation extends Service
{
    /**
     * Replace all
     *
     * @var string
     */
    public const API_PATH = 'https://www.googleapis.com/geolocation/v1/geolocate';

    /**
     * Geolocate
     *
     * @param \yidas\googleMaps\Client $client
     * @param array $bodyParams
     *
     * @return array Result
     */
    public static function geolocate(Client $client, array $bodyParams = [])
    {
        // Google API request body format
        $body = json_encode($bodyParams) ?: null;

        return self::requestHandler($client, self::API_PATH, [], 'POST', $body);
    }
}
