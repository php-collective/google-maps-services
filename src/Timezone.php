<?php

namespace yidas\googleMaps;

use DateTime;
use Throwable;

/**
 * Directions Service
 *
 * @author Nick Tsai <myintaer@gmail.com>
 * @since 1.0.0
 * @see https://developers.google.com/maps/documentation/timezone/
 */
class Timezone extends Service
{
    /**
     * @var string
     */
    public const API_PATH = '/maps/api/timezone/json';

    /**
     * Timezone
     *
     * @param \yidas\googleMaps\Client $client
     * @param array|string $location
     * @param \DateTime|string|int|null $timestamp
     * @param array $params
     *
     * @return array Result
     */
    public static function timezone(Client $client, $location, $timestamp = null, array $params = [])
    {
        // `location` seems to only allow `lat,lng` pattern
        if (is_string($location)) {
            $params['location'] = $location;
        } else {
            [$lat, $lng] = $location;
            $params['location'] = "{$lat},{$lng}";
        }

        if ($timestamp instanceof DateTime) {
            $timestamp = $timestamp->getTimestamp();
        } elseif ($timestamp !== null && is_scalar($timestamp) && !is_numeric($timestamp)) {
            try {
                $dt = new DateTime($timestamp);
                $timestamp = $dt->getTimestamp();
            } catch (Throwable $t) {
                $timestamp = time();
            }
        } elseif ($timestamp === null || !is_scalar($timestamp) || !is_numeric($timestamp)) {
            $timestamp = time();
        } //else we know it's scalar and numeric, so use it as-is


        $params['timestamp'] = (int)$timestamp;

        return self::requestHandler($client, self::API_PATH, $params);
    }
}
