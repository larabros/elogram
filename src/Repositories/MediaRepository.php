<?php

namespace Larabros\Elogram\Repositories;

use Larabros\Elogram\Http\Response;

/**
 * MediaRepository
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
class MediaRepository extends AbstractRepository
{
    /**
     * Get information about a media object.
     *
     * @param string $id  The ID of the media object
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
     * This method returns the same response as :php:meth:`MediaRepository::get`
     *
     * @param string $shortcode  The shortcode of the media object
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
     * Search for recent media in a given area.
     *
     * @param int $latitude   Latitude of the center search coordinate. If used, ``$longitude`` is required
     * @param int $longitude  Longitude of the center search coordinate. If used, ``$latitude`` is required
     * @param int $distance   The distance in metres. Default is ``1000``m, max distance is 5km.
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
