===
FAQ
===

Why is there no way to access the `users/feed` endpoint?
========================================================

Since the endpoint has been deprecated, we've chosen not to implement it in this
package.

Why can't I use a Foursquare V1 ID to search for locations?
===========================================================

Foursquare has been providing new V2 IDs for places for some time now, we do not
plan to support them as a native method. You can still make the request
manually:

.. code-block::php

    use Larabros\Elogram\Client;

    $client   = new Client($clientId, $clientSecret, $accessToken, $redirectUrl);
    $params = ['query' => ['FOURSQUARE_ID' => $foursquareId]];
    $response = $client->request('GET', 'locations/search', $params);
    echo json_encode($response->get());
