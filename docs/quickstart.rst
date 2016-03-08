==========
Quickstart
==========

This page provides a quick introduction to Elogram and introductory examples.
If you have not already installed, head over to the :ref:`installation`
page.

.. _access_token:

Getting an access token
=======================

To make requests to the Instagram API, you need an access token. To do this, first instantiate
``Instagram`` - the ``$clientId``, ``$clientSecret`` and ``$redirectUrl`` **must** be the same
as in the `Instagram Developer Panel <https://www.instagram.com/developer/clients/manage/>`_:


Creating a Client
-----------------

.. code-block:: php

    use Elogram\Instagram;

    $client = new Instagram($clientId, $clientSecret, null, $redirectUrl);

The client constructor accepts the following parameters:

``clientId``
    Generated when you create a new application from the Instagram developer
    panel.

``clientSecret``
    Also generated when you create a new application from the Instagram developer
    panel.

``accessToken``
    Assuming you do not currently have one, use ``null``.

``redirectUrl``
    The URL to redirect to after a user authorizes the Instagram client.

After instantiating the client, retrieve the login helper object and redirect to
the authorization page (or retrieve an access token if the user has authorized):

.. code-block:: php

    // If we don't have an authorization code then get one
    if (!isset($_GET['code'])) {
        header('Location: ' . $client->getLoginUrl());
        exit;
    } else {
        $token = $client->getAccessToken($_GET['code']);
        echo json_encode($token);
    }

    // You can now make requests to the API
    $client->users()->search('skrawg');


Sending Requests
================

Simple requests
---------------

.. code-block:: php

    use Elogram\Instagram;

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $client->users()->find('skrawg');
    echo json_encode($response->get());

    $response = $client->media()->getByShortcode('9RV6okpRin');
    echo json_encode($response->get());


Paginated Requests
------------------

The `Response` object that you receive from making requests contains the data
from the multiple requests combined, including the first one. You can also pass
a ``$limit`` as an optional parameter to ``Instagram::paginate()``, which sets
the number of pages to request, assuming they are available.

.. code-block:: php

    use Elogram\Instagram;

    $client   = new Instagram($clientId, $clientSecret, $accessToken);
    $response = $instagram->users()->follows();
    echo json_encode($response->get());

    $response = $instagram->paginate($response, 2);
    echo json_encode($response->get());

    $response = $instagram->paginate($response);
    echo json_encode($response->get());
