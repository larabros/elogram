.. title:: Elogram

=============
Documentation
=============

Elogram is a PHP client for the Instagram API. It offers:

- Simple interface for interacting with the web API. Use methods and arguments
  instead of cURL.
- Provides an easy-to-use CSRF-protected solution for retrieving access tokens.
- Well-tested
- Makes pagination a breeze.

.. code-block:: php

    $client = new \Instagram\Instagram($clientId, $clientSecret, $accessToken);

    header('Content-Type: application/json');
    $response = $client->media()->search(51.503349, -0.252271);
    echo json_encode($response->get());

    $response = $instagram->users()->find('skrawg');
    echo json_encode($response->get());

    $response  = $instagram->users()->follows();
    echo json_encode($response->get());

    $response  = $client->paginate($response, 2);
    echo json_encode($response->get());



User Guide
==========

.. toctree::
    :glob:
    :maxdepth: 3

    overview
    quickstart
    endpoints/*
    faq
    developers
