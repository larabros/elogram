------------------------------------------------
Larabros\\Elogram\\Repositories\\UsersRepository
------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Repositories

.. php:class:: UsersRepository

    UsersRepository

    .. php:attr:: client

        protected AdapterInterface

    .. php:method:: get($id = 'self')

        Get information about a user.

        :type $id: string
        :param $id: The ID of the user. Default is ``self``
        :returns: Response

    .. php:method:: getMedia($id = 'self', $count = null, $minId = null, $maxId = null)

        Get the most recent media published by a user.

        :param $id:
        :type $count: int|null
        :param $count: Count of media to return
        :type $minId: int|null
        :param $minId: Return media later than this min_id
        :type $maxId: int|null
        :param $maxId: Return media earlier than this max_id
        :returns: Response

    .. php:method:: getLikedMedia($count = null, $maxLikeId = null)

        Get the list of recent media liked by the owner of the access token.

        :type $count: int|null
        :param $count: Count of media to return
        :type $maxLikeId: int|null
        :param $maxLikeId: Return media liked before this id
        :returns: Response

    .. php:method:: search($query, $count = null)

        Get a list of users matching the query.

        :param $query:
        :param $count:
        :returns: Response

    .. php:method:: find($username)

        Searches for and returns a single user's information. If no results
        are found, ``null`` is returned.

        :type $username: string
        :param $username: A username to search for
        :returns: Response|null

    .. php:method:: follows()

        Get the list of users this user follows.

        :returns: Response

    .. php:method:: followedBy()

        Get the list of users this user is followed by.

        :returns: Response

    .. php:method:: requestedBy()

        List the users who have requested this user's permission to follow.

        :returns: Response

    .. php:method:: getRelationship($targetUserId)

        Get information about the relationship of the owner of the access token
        to another user.

        :type $targetUserId: string
        :param $targetUserId: The ID of the target user
        :returns: Response

    .. php:method:: setRelationship($targetUserId, $action)

        Modify the relationship between the owner of the access token and the
        target user.

        :type $targetUserId: string
        :param $targetUserId: The ID of the target user
        :type $action: string
        :param $action: Can be one of:  ``follow | unfollow | approve | ignore``
        :returns: Response

    .. php:method:: __construct(AdapterInterface $client)

        Creates a new instance of :php:class:`AbstractRepository`.

        :type $client: AdapterInterface
        :param $client:
