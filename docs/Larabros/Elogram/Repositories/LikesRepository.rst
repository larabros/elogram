------------------------------------------------
Larabros\\Elogram\\Repositories\\LikesRepository
------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Repositories

.. php:class:: LikesRepository

    LikesRepository class.

    .. php:attr:: client

        protected AdapterInterface

    .. php:method:: get($mediaId)

        Get a list of likes on a media object.

        :type $mediaId: int
        :param $mediaId: The ID of the media object
        :returns: Response

    .. php:method:: like($mediaId)

        Set a like on a media object by the currently authenticated user.

        :type $mediaId: int
        :param $mediaId: The ID of the media object
        :returns: Response

    .. php:method:: unlike($mediaId)

        Remove a like on a media object by the currently authenticated user.

        :type $mediaId: int
        :param $mediaId: The ID of the media object
        :returns: Response

    .. php:method:: __construct(AdapterInterface $client)

        Creates a new instance of :php:class:`AbstractRepository`.

        :type $client: AdapterInterface
        :param $client:
