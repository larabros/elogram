.. module:: sphinxcontrib.httpdomain

========
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
