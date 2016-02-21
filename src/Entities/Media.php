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
     * @see https://www.instagram.com/developer/endpoints/media/#get_media
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
     * @see https://www.instagram.com/developer/endpoints/media/#get_media_by_shortcode
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
     * @param int      $latitude
     * @param int      $longitude
     * @param int|null $minTimestamp
     * @param int|null $maxTimestamp
     * @param int|null $distance
     *
     * @return Response
     *
     * @see https://www.instagram.com/developer/endpoints/media/#get_media_search
     */
    public function search(
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
                'min_timestamp' => $minTimestamp,
                'max_timestamp' => $maxTimestamp,
                'distance'      => $distance,
            ],
        ];

        return $this->client->request('GET', 'media/search', $params);
    }
}