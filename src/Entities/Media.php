<?php

namespace Instagram\Entities;

use Instagram\Client;
use Instagram\Http\Response;

class Media
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Creates a new instance of `Media`.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieves media information by `$id`.
     *
     * @param $id
     *
     * @return mixed
     */
    public function getMedia($id)
    {
        return $this->getClient()->request('GET', "media/$id");
    }

    /**
     * Retrieves media information by `$shortcode`, which are usually in embed
     * links.
     *
     * @param $shortcode
     *
     * @return mixed
     */
    public function getMediaByShortcode($shortcode)
    {
        return $this->getClient()->request('GET', "media/shortcode/$shortcode");
    }

    /**
     *
     *
     * @param $latitude
     * @param $longitude
     * @param null $minTimestamp
     * @param null $maxTimestamp
     * @param null $distance
     *
     * @return mixed
     */
    public function searchMedia(
        $latitude,
        $longitude,
        $minTimestamp = null,
        $maxTimestamp = null,
        $distance = null
    ) {
        $params = [
            'query' => [
                'lat'           => $latitude,
                'lng'           => $longitude,
                'min_timestamp' => '',
                'max_timestamp' => '',
                'distance'      => '',
            ],
        ];
        if(is_null($minTimestamp)) unset($params['min_timestamp']);
        if(is_null($maxTimestamp)) unset($params['max_timestamp']);
        if(is_null($distance))     unset($params['distance']);

        return $this->getClient()->request('GET', 'media/search', $params);
    }

    public function getPopularMedia()
    {
        return $this->getClient()->request('GET', 'media/popular');
    }
}