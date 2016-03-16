<?php

namespace Larabros\Elogram\Repositories;

use Larabros\Elogram\Http\Response;

/**
 * LocationsRepository
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
class LocationsRepository extends AbstractRepository
{

    /**
     * Get information about a location.
     *
     * @param string $id  The ID of the location
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/locations/#get_locations
     */
    public function get($id)
    {
        return $this->client->request('GET', "locations/$id");
    }

    /**
     * Get a list of recent media objects from a given location.
     *
     * @param string      $id     The ID of the location
     * @param string|null $minId  Return media before this min_id
     * @param string|null $maxId  Return media after this max_id
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/locations/#get_locations_media_recent
     */
    public function getRecentMedia($id, $minId = null, $maxId = null)
    {
        $params = ['query' => [
            'min_id' => $minId,
            'max_id' => $maxId,
        ]];
        return $this->client->request('GET', "locations/$id/media/recent", $params);
    }

    /**
     * Search for a location by geographic coordinate.
     *
     * @param int $latitude   Latitude of the center search coordinate. If used, ``$longitude`` is required
     * @param int $longitude  Longitude of the center search coordinate. If used, ``$latitude`` is required
     * @param int $distance   The distance in metres. Default is ``1000``m, max distance is 5km
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/locations/#get_locations_search
     */
    public function search($latitude, $longitude, $distance = 1000)
    {
        $params = ['query' => [
            'lat'      => $latitude,
            'lng'      => $longitude,
            'distance' => $distance,
        ]];

        return $this->client->request('GET', 'locations/search', $params);
    }

    /**
     * Search for a location by Facebook Places ID.
     *
     * @param int $facebookPlacesId  A Facebook Places ID
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/locations/#get_locations_search
     */
    public function searchByFacebookPlacesId($facebookPlacesId)
    {
        $params = ['query' => ['facebook_places_id' => $facebookPlacesId]];
        return $this->client->request('GET', 'locations/search', $params);
    }

    /**
     * Search for a location by Foursquare location ID.
     *
     * @param string $foursquareId  A Foursquare V2 API location ID
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/locations/#get_locations_search
     */
    public function searchByFoursquareId($foursquareId)
    {
        $params = ['query' => ['foursquare_v2_id' => $foursquareId]];
        return $this->client->request('GET', 'locations/search', $params);
    }
}
