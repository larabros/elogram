------------------------------------------------
Larabros\\Elogram\\Repositories\\MediaRepository
------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Repositories

.. php:class:: MediaRepository

    MediaRepository

    .. php:attr:: client

        protected AdapterInterface

    .. php:method:: get($id)

        Get information about a media object.

        :type $id: string
        :param $id: The ID of the media object
        :returns: Response

    .. php:method:: getByShortcode($shortcode)

        This method returns the same response as :php:meth:`MediaRepository::get`

        :type $shortcode: string
        :param $shortcode: The shortcode of the media object
        :returns: Response

    .. php:method:: search($latitude, $longitude, $distance = 1000)

        Search for recent media in a given area.

        :type $latitude: int
        :param $latitude: Latitude of the center search coordinate. If used, ``$longitude`` is required
        :type $longitude: int
        :param $longitude: Longitude of the center search coordinate. If used, ``$latitude`` is required
        :type $distance: int
        :param $distance: The distance in metres. Default is ``1000``m, max distance is 5km.
        :returns: Response

    .. php:method:: __construct(AdapterInterface $client)

        Creates a new instance of :php:class:`AbstractRepository`.

        :type $client: AdapterInterface
        :param $client:
