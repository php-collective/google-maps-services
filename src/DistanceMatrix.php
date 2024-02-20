<?php

namespace yidas\googleMaps;

/**
 * Directions Service
 *
 * @author Nick Tsai <myintaer@gmail.com>
 * @since 1.0.0
 * @see https://developers.google.com/maps/documentation/distance-matrix/
 */
class DistanceMatrix extends Service
{
    /**
     * @var string
     */
    public const API_PATH = '/maps/api/distancematrix/json';

    /**
     * Distance matrix
     *
     * @param \yidas\googleMaps\Client $client
     * @param array|string $origins
     * @param array|string $destinations
     * @param array $params
     *
     * @return array Result
     */
    public static function distanceMatrix(Client $client, $origins, $destinations, array $params = [])
    {
        if (is_array($origins)) {
            $origins = implode('|', $origins);
        }

        if (is_array($destinations)) {
            $destinations = implode('|', $destinations);
        }

        $params['origins'] = (string)$origins;
        $params['destinations'] = (string)$destinations;

        return self::requestHandler($client, self::API_PATH, $params);
    }
}
