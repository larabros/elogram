==========
Quickstart
==========

This page provides a quick introduction to Instagram-SDK and introductory examples.
If you have not already installed, head over to the :ref:`installation`
page.


Getting an access token
================

To make requests to the Instagram API, you need an access token. To do this, first instantiate ``Instagram`` - the ``$clientId``, ``$clientSecret`` and ``$redirectUrl`` **must** be the same as what you see in the [Instagram Developer Panel](https://www.instagram.com/developer/clients/manage/):


Creating a Client
-----------------

.. code-block:: php

    use Instagram\Instagram;

    $client = new Instagram($clientId, $clientSecret, $accessToken, $redirectUrl);

The client constructor accepts the following parameters:

``clientId``
    Generated when you create a new application from the Instagram developer
    panel.

``clientSecret``
    Also generated when you create a new application from the Instagram developer
    panel.

``accessToken``
    If you do not currently have one, use ``null``.

``redirectUrl``
    The URL to redirect to after a user authorizes the Instagram client.

To retrieve an access token, first instantiate the client, then retrieve the
login helper object and check whether to redirect or retrieve an access token:

.. code-block:: php

    // Create a client
    $client = new Instagram($clientId, $clientSecret, null, $redirectUrl);
    $helper = $instagram->getLoginHelper();
    // If we don't have an authorization code then get one
    if (!isset($_GET['code'])) {
        header('Location: ' . $helper->getLoginUrl());
        exit;
    } else {
        $token = $helper->getAccessToken($_GET['code']);
        echo json_encode($token);
    }


Sending Requests
================

