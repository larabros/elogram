.. module:: sphinxcontrib.httpdomain

=========
Endpoints
=========

This page provides a list of all endpoints supported by Instagram-SDK and
introductory examples. If you have not already acquired an access token, head
over to the :ref:`access_token` page.


Users
=====

.. http:get:: /users/(string:$id)

.. warning::

    The ``public_content`` scope mst be set on the access token if a user with
    ``$id`` is not the owner of the access token.

**Example request**:

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->get(4);
    echo json_encode($response);

**Example response**:

.. code-block:: json

    {
        "username": "mikeyk",
        "first_name": "Mike",
        "profile_picture": "http://distillery.s3.amazonaws.com/profiles/profile_4_75sq_1292324747_debug.jpg",
        "id": "4",
        "last_name": "Krieger!!"
    }

:param id: The ID of a user. Default is ``self``.

``get($id = 'self')``
---------------------

.. important::

    The ``public_content`` scope is required if a user with ``$id`` is not the
    owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->get('268047373');
    echo json_encode($response);

``getMedia($id = 'self', $count = null, $minId = null, $maxId = null)``
-----------------------------------------------------------------------

.. important::

    The ``public_content`` scope is required if a user with ``$id`` is not the
    owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->getMedia('268047373');
    echo json_encode($response);

``getLikedMedia($count = null, $maxLikeId = null)``
---------------------------------------------------

.. important::

    This method only works for the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->getLikedMedia();
    echo json_encode($response);

``search($query, $count = null)``
---------------------------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->search('skrawg');
    echo json_encode($response);

``find($username)``
-------------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->find('skrawg');
    echo json_encode($response);

``follows()``
-------------

.. important::

    This method only works for the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->follows();
    echo json_encode($response);

``followedBy()``
----------------

.. important::

    This method only works for the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->followedBy();
    echo json_encode($response);

``requestedBy()``
-----------------

.. important::

    This method only works for the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->requestedBy();
    echo json_encode($response);

``getRelationship($id)``
------------------------

.. important::

    This method only works for the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->getRelationship('268047373');
    echo json_encode($response);

``setRelationship($id, $action)``
---------------------------------

.. important::

    This method only works for the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->setRelationship(268047373, 'follows');
    echo json_encode($response);

Media
=====

``get($id)``
------------

.. important::

    The ``public_content`` permission scope is required to get a media object
    that does not belong to the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->media()->get('1109588739516340817_268047373');
    echo json_encode($response);

``getByShortcode($shortcode)``
------------------------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->media()->getByShortcode('9RV6okpRin');
    echo json_encode($response);

``search($latitude, $longitude, $distance = 1000)``
---------------------------------------------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->media()->search(51.503349, -0.252271);
    echo json_encode($response);

Comments
========

``get($mediaId)``
-----------------

.. important::

    The ``public_content`` permission scope is required to get comments for a
    media object that does not belong to the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->comments()->get('1109588739516340817_268047373');
    echo json_encode($response);

``create($mediaId, $text)``
---------------------------

.. important::

    The ``public_content`` permission scope is required to create comments for a
    media object that does not belong to the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->comments()->create('1109588739516340817_268047373', 'A comment');
    echo json_encode($response);

``delete($mediaId, $commentId)``
--------------------------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->comments()->delete('1109588739516340817_268047373', 3);
    echo json_encode($response);

Likes
=====

``get($mediaId)``
-----------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->likes()->get('1109588739516340817_268047373');
    echo json_encode($response);

``like($mediaId)``
------------------

.. important::

    The ``public_content`` permission scope is required to create likes on a
    media object that does not belong to the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->likes()->like('1109588739516340817_268047373');
    echo json_encode($response);

``unlike($mediaId)``
--------------------

.. important::

    The ``public_content`` permission scope is required to delete likes on a
    media object that does not belong to the owner of the access token.

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->likes()->unlike('1109588739516340817_268047373');
    echo json_encode($response);


Tags
====

``get($tag)``
-------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->tags()->get('snowy');
    echo json_encode($response);

``getRecentMedia($tag, $count = null, $minTagId = null, $maxTagId = null)``
---------------------------------------------------------------------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->tags()->getRecentMedia('snowy');
    echo json_encode($response);

``search($tag)``
----------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->tags()->search('snow');
    echo json_encode($response);


Locations
=========

``get($id)``
------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->locations()->get('1');
    echo json_encode($response);

``getRecentMedia($id, $minId = null, $maxId = null)``
-----------------------------------------------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->locations()->getRecentMedia('1');
    echo json_encode($response);

``search($latitude, $longitude, $distance = 1000)``
---------------------------------------------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->locations()->search(48.858325999999998, 2.294505);
    echo json_encode($response);

``searchByFacebookPlacesId($facebookPlacesId)``
-----------------------------------------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->locations()->searchByFacebookPlacesId(114226462057675);
    echo json_encode($response);

``searchByFoursquareId($foursquareId)``
---------------------------------------

.. code-block:: php

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->locations()->searchByFoursquareId('51a2445e5019c80b56934c75');
    echo json_encode($response);
