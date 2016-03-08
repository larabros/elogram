.. module:: sphinxcontrib.httpdomain

=========
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
