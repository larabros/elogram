.. module:: sphinxcontrib.httpdomain

=====
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
