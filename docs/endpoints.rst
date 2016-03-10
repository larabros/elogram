=========
Endpoints
=========

.. warning::
    All code examples below assume you have already instantiated the ``Client``
    class with a valid access token.

Users
=====

.. php:method:: get($id = 'self')

    Get information about a user.

    :type $id: string
    :param $id: The ID of the user. Default is ``self``
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->users()->get(4);
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_users.json
        :language: php

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

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->users()->getMedia('268047373');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_users_media_recent.json
        :language: php

.. php:method:: getLikedMedia($count = null, $maxLikeId = null)

    Get the list of recent media liked by the owner of the access token.

    :type $count: int|null
    :param $count: Count of media to return
    :type $maxLikeId: int|null
    :param $maxLikeId: Return media liked before this id
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->users()->getLikedMedia();
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_users_media_liked.json
        :language: php

.. php:method:: search($query, $count = null)

    Get a list of users matching the query.

    :param $query:
    :param $count:
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->users()->search('skrawg');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_users_search.json
        :language: php

.. php:method:: find($username)

    Searches for and returns a single user's information. If no results
    are found, ``null`` is returned.

    :type $username: string
    :param $username: A username to search for
    :returns: Response|null

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->users()->find('mikeyk');
        echo json_encode($response->get());

    **Example response:**

    .. code-block:: json

        {
            "meta":
            {
                "code": 200
            },
            "data": {
                "username": "mikeyk",
                "first_name": "Mike",
                "profile_picture": "http://distillery.s3.amazonaws.com/profiles/profile_4_75sq_1292324747_debug.jpg",
                "id": "4",
                "last_name": "Krieger!!"
            }
        }


Relationships
=============

.. php:method:: follows()

    Get the list of users this user follows.

    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->users()->follows();
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_users_follows.json
        :language: php

.. php:method:: followedBy()

    Get the list of users this user is followed by.

    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->users()->followedBy();
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_users_followed_by.json
        :language: php

.. php:method:: requestedBy()

    List the users who have requested this user's permission to follow.

    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->users()->requestedBy();
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_users_requested_by.json
        :language: php

.. php:method:: getRelationship($targetUserId)

    Get information about the relationship of the owner of the access token
    to another user.

    :type $targetUserId: string
    :param $targetUserId: The ID of the target user
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->users()->getRelationship('268047373');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_users_relationship.json
        :language: php

.. php:method:: setRelationship($targetUserId, $action)

    Modify the relationship between the owner of the access token and the
    target user.

    :type $targetUserId: string
    :param $targetUserId: The ID of the target user
    :type $action: string
    :param $action: Can be one of:  ``follow | unfollow | approve | ignore``
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->users()->setRelationship('268047373', 'follows');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/post_users_relationship.json
        :language: php


Media
=====

.. php:method:: get($id)

    Get information about a media object.

    :type $id: string
    :param $id: The ID of the media object
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->media()->get('315');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_media.json
        :language: php

.. php:method:: getByShortcode($shortcode)

    This method returns the same response as :php:meth:`Media::get`

    :type $shortcode: string
    :param $shortcode: The shortcode of the media object
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->media()->getByShortcode('9mDRRppRE7');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_media.json
        :language: php

.. php:method:: search($latitude, $longitude, $distance = 1000)

    Search for recent media in a given area.

    :type $latitude: int
    :param $latitude: Latitude of the center search coordinate. If used, ``$longitude`` is required
    :type $longitude: int
    :param $longitude: Longitude of the center search coordinate. If used, ``$latitude`` is required
    :type $distance: int
    :param $distance: The distance in metres. Default is ``1000``m, max distance is 5km.
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->media()->search(37.78, -122.22);
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_media_search.json
        :language: php


Comments
========

.. php:method:: get($mediaId)

    Get a list of recent comments on a media object.

    :type $mediaId: int
    :param $mediaId: The ID of the media object
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->comments()->get(420);
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_media_comments.json
        :language: php

.. php:method:: create($mediaId, $text)

    Create a comment on a media object using the following rules:

    - The total length of the comment cannot exceed 300 characters.
    - The comment cannot contain more than 4 hashtags.
    - The comment cannot contain more than 1 URL.
    - The comment cannot consist of all capital letters.

    :param $mediaId:
    :type $text: string
    :param $text: Text to post as a comment on the media object as specified by `$mediaId`
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->comments()->create(315, 'A comment');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/post_media_comments.json
        :language: php

.. php:method:: delete($mediaId, $commentId)

    Remove a comment either on the owner of the access token's media object
    or authored by the owner of the access token.

    :param $mediaId:
    :type $commentId: string
    :param $commentId: The ID of the comment
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->comments()->delete(315, 1);
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/delete_media_comments.json
        :language: php


Likes
=====

.. php:method:: get($mediaId)

    Get a list of likes on a media object.

    :type $mediaId: int
    :param $mediaId: The ID of the media object
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->likes()->get(420);
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_media_likes.json
        :language: php

.. php:method:: like($mediaId)

    Set a like on a media object by the currently authenticated user.

    :type $mediaId: int
    :param $mediaId: The ID of the media object
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->likes()->like(315);
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/post_media_likes.json
        :language: php

.. php:method:: unlike($mediaId)

    Remove a like on a media object by the currently authenticated user.

    :type $mediaId: int
    :param $mediaId: The ID of the media object
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->likes()->unlike(315);
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/delete_media_likes.json
        :language: php


Tags
====

.. php:method:: get($tag)

    Get information about a tag object.

    :type $tag: string
    :param $tag: Name of the tag
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->tags()->get('nofilter');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_tags_nofilter.json
        :language: php

.. php:method:: getRecentMedia($tag, $count = null, $minTagId = null, $maxTagId = null)

    Get a list of recently tagged media.

    :param $tag:
    :param $count:
    :type $minTagId: string|null
    :param $minTagId: Return media before this min_tag_id
    :type $maxTagId: string|null
    :param $maxTagId: Return media after this max_tag_id
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->tags()->getRecentMedia('snowy');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_tags_snowy_media_recent.json
        :language: php

.. php:method:: search($tag)

    Search for tags by name.

    :type $tag: string
    :param $tag: Name of the tag
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->tags()->search('snowy');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_tags_search.json
        :language: php


Locations
=========

.. php:method:: get($id)

    Get information about a location.

    :type $id: string
    :param $id: The ID of the location
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->locations()->get('1');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_locations.json
        :language: php

.. php:method:: getRecentMedia($id, $minId = null, $maxId = null)

    Get a list of recent media objects from a given location.

    :param $id:
    :type $minId: string|null
    :param $minId: Return media before this min_id
    :type $maxId: string|null
    :param $maxId: Return media after this max_id
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->locations()->getRecentMedia('514276');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_locations_media_recent.json
        :language: php

.. php:method:: search($latitude, $longitude, $distance = 1000)

    Search for a location by geographic coordinate.

    :type $latitude: int
    :param $latitude: Latitude of the center search coordinate. If used, ``$longitude`` is required
    :type $longitude: int
    :param $longitude: Longitude of the center search coordinate. If used, ``$latitude`` is required
    :type $distance: int
    :param $distance: The distance in metres. Default is ``1000``m, max distance is 5km
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->locations()->search(48.858325999999998, 2.294505);
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_locations_search.json
        :language: php

.. php:method:: searchByFacebookPlacesId($facebookPlacesId)

    Search for a location by Facebook Places ID.

    :type $facebookPlacesId: int
    :param $facebookPlacesId: A Facebook Places ID
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->locations()->searchByFacebookPlacesId(114226462057675);
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_locations_search_facebook_places_id.json
        :language: php

.. php:method:: searchByFoursquareId($foursquareId)

    Search for a location by Foursquare location ID.

    :type $foursquareId: string
    :param $foursquareId: A Foursquare V2 API location ID
    :returns: Response

    **Example request:**

    .. code-block:: php

        $client   = new Client($clientId, $clientSecret, $accessToken);
        $response = $client->locations()->searchByFoursquareId('51a2445e5019c80b56934c75');
        echo json_encode($response->get());

    **Example response:**

    .. literalinclude:: /../tests/fixtures/get_locations_search_foursquare_v2_id.json
        :language: php
