.. module:: sphinxcontrib.httpdomain

=====
Users
=====

.. http:get:: /users/(string:$id)

    :param id: The ID of a user. Default is ``self``.

    .. warning::

        The ``public_content`` scope must be set on the access token if the user
        with ``$id`` is not the owner of the access token.

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
