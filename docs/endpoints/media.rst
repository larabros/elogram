.. module:: sphinxcontrib.httpdomain

=====
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
