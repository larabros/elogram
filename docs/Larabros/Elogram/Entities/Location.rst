-------------------------------------
Larabros\\Elogram\\Entities\\Location
-------------------------------------

.. php:namespace: Larabros\\Elogram\\Entities

.. php:class:: Location

    Location

    .. php:attr:: client

        protected AdapterInterface

    .. php:method:: get($id)

        Get information about a location.

        :type $id: string
        :param $id: The ID of the location
        :returns: Response

    .. php:method:: getRecentMedia($id, $minId = null, $maxId = null)

        Get a list of recent media objects from a given location.

        :param $id:
        :type $minId: string|null
        :param $minId: Return media before this min_id
        :type $maxId: string|null
        :param $maxId: Return media after this max_id
        :returns: Response

    .. php:method:: search($latitude, $longitude, $distance = 1000)

        Search for a location by geographic coordinate.

        :type $latitude: int
        :param $latitude: Latitude of the center search coordinate. If used, ``$longitude`` is required
        :type $longitude: int
        :param $longitude: Longitude of the center search coordinate. If used, ``$latitude`` is required
        :type $distance: int
        :param $distance: The distance in metres. Default is ``1000``m, max distance is 5km
        :returns: Response

    .. php:method:: searchByFacebookPlacesId($facebookPlacesId)

        Search for a location by Facebook Places ID.

        :type $facebookPlacesId: int
        :param $facebookPlacesId: A Facebook Places ID
        :returns: Response

    .. php:method:: searchByFoursquareId($foursquareId)

        Search for a location by Foursquare location ID.

        :type $foursquareId: string
        :param $foursquareId: A Foursquare V2 API location ID
        :returns: Response

    .. php:method:: __construct(AdapterInterface $client)

        Creates a new instance of :php:class:`AbstractEntity`.

        :type $client: AdapterInterface
        :param $client:
