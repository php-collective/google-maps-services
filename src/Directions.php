<?php

namespace yidas\googleMaps;

/**
 * Directions Service
 *
 * @author Nick Tsai <myintaer@gmail.com>
 * @since 1.0.0
 * @see https://developers.google.com/maps/documentation/directions/
 */
class Directions extends Service
{
    /**
     * @var string
     */
    public const API_PATH = '/maps/api/directions/json';

    /**
     * Directions
     *
     * @param \yidas\googleMaps\Client $client
     * @param string $origin
     * @param string $destination
     * @param array $params
     *
     * @return array Result
     */
    public static function directions(Client $client, $origin, $destination, array $params = [])
    {
        $params['origin'] = (string)$origin;
        $params['destination'] = (string)$destination;

        return self::requestHandler($client, self::API_PATH, $params);
    }
}
