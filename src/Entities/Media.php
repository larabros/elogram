<?php

namespace Instagram\Entities;

use Instagram\Http\Response;

/**
 * Media
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class Media extends AbstractEntity
{
    /**
     * Retrieves information for a media object with `$id`.
     *
     * @param string $id
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/media/#get_media
     */
    public function get($id)
    {
        return $this->client->request('GET', "media/$id");
    }

    /**
     * Retrieves information for a media object with `$shortcode`.
     *
     * @param string $shortcode
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/media/#get_media_by_shortcode
     */
    public function getByShortcode($shortcode)
    {
        return $this->client->request('GET', "media/shortcode/$shortcode");
    }

    /**
     * Searches for recent media in a given area with `$latitude` and $longitude`.
     * Optionally, `$minTimestamp`, $maxTimestamp` and `$distance` can also be
     * provided to limit the search.
     *
     * @param int $latitude   Latitude of the center search coordinate. If used, lng is required
     * @param int $longitude  Longitude of the center search coordinate. If used, lat is required
     * @param int $distance   The distance in metres. Default is 1000m (distance=1000), max distance is 5km.
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/media/#get_media_search
     */
    public function search($latitude, $longitude, $distance = 1000)
    {
        $params = ['query' => [
            'lat'      => $latitude,
            'lng'      => $longitude,
            'distance' => $distance,
        ]];

        return $this->client->request('GET', 'media/search', $params);
    }
}