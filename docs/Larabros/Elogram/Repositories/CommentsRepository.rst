---------------------------------------------------
Larabros\\Elogram\\Repositories\\CommentsRepository
---------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Repositories

.. php:class:: CommentsRepository

    CommentsRepository

    .. php:attr:: client

        protected AdapterInterface

    .. php:method:: get($mediaId)

        Get a list of recent comments on a media object.

        :type $mediaId: int
        :param $mediaId: The ID of the media object
        :returns: Response

    .. php:method:: create($mediaId, $text)

        Create a comment on a media object using the following rules:

        - The total length of the comment cannot exceed 300 characters.
        - The comment cannot contain more than 4 hashtags.
        - The comment cannot contain more than 1 URL.
        - The comment cannot consist of all capital letters.

        :param $mediaId:
        :type $text: string
        :param $text: Text to post as a comment on the media object
        :returns: Response

    .. php:method:: delete($mediaId, $commentId)

        Remove a comment either on the owner of the access token's media object
        or authored by the owner of the access token.

        :param $mediaId:
        :type $commentId: string
        :param $commentId: The ID of the comment
        :returns: Response

    .. php:method:: __construct(AdapterInterface $client)

        Creates a new instance of :php:class:`AbstractRepository`.

        :type $client: AdapterInterface
        :param $client:
