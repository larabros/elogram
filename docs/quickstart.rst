==========
Quickstart
==========

This page provides a quick introduction to Elogram and introductory examples.
If you have not already installed, head over to the :ref:`installation`
page.

.. _access_token:

Authentication
==============

To start making requests, you need to authenticate and retrieve an access token.
To do this, first instantiate the :php:class:`Client` class:

.. important::

    The ``$clientId``, ``$clientSecret`` and ``$redirectUrl`` **must** be the
    same as in the `Instagram Developer Panel
    <https://www.instagram.com/developer/clients/manage/>`_

.. important::

    You should always store your client ID and secret as an environment
    variable, or otherwise out of source control. An excellent tool to help
    you do this is the `vlucas/phpdotenv <https://github.com/vlucas/phpdotenv>`_
    package.


Creating a Client
-----------------

.. code-block:: php

    use Larabros\Elogram\Client;

    $client = new Client($clientId, $clientSecret, null, $redirectUrl);


Setting up the authentication flow
----------------------------------

After instantiating the client, retrieve the the authorization page URL (or
retrieve an access token if the user has already authorized):

.. code-block:: php

    // If we don't have an authorization code then get one
    if (!isset($_GET['code'])) {
        header('Location: ' . $client->getLoginUrl());
        exit;
    } else {
        $token = $client->getAccessToken($_GET['code']);
        echo json_encode($token); // Save this for future use
    }

    // You can now make requests to the API
    $client->users()->search('skrawg');

Using an existing token
-----------------------

If you have an access token in the form of a JSON string, then instantiate the
:php:class:`Client` class with it:

.. code-block:: php

    use Larabros\Elogram\Client;

    $client = new Client($clientId, $clientSecret, $accessToken, $redirectUrl);


You can also add the access token after instantiation:

.. code-block:: php

    use Larabros\Elogram\Client;

    $client = new Client($clientId, $clientSecret, null, $redirectUrl);

    //
    // Retrieve the access token from somewhere
    //

    $client->setAccessToken($token);



Login permissions (Scopes)
==========================

You can request additional access scopes for the access token by passing an
array to the :php:meth:`Client::getLoginUrl()` method:

.. code-block:: php

    $options  = ['scope' => 'basic public_content'];
    $loginUrl = $client->getLoginUrl($options);

Note that the scopes **must** separated by a space. Available scopes are listed
on the `Instagram Developer
<https://www.instagram.com/developer/authorization/>`_ website.

Secure Requests
===============

.. important::

    Secure requests **must** be enabled in the `Instagram Developer Panel
    <https://www.instagram.com/developer/clients/manage/>`_ for your
    application.

Secure requests can be enabled by calling :php:meth:`Client::secureRequests()`.

.. code-block:: php

    // Enables secure requests
    $client->secureRequests();

    // Disables secure requests
    $client->secureRequests(false);


Sending Requests
================


Simple requests
---------------

To simplify requests to the API, it is recommended you read Endpoints. However,
sometimes you may need to make a call to the API without syntactic sugar; for
this you can use :php:meth:`Client::request()`:

.. code-block:: php

    use Larabros\Elogram\Client;

    $client   = new Client($clientId, $clientSecret, $accessToken, $redirectUrl);
    $response = $client->request('GET', 'users/self');
    echo json_encode($response->get());


Paginated Requests
------------------

The `Response` object that you receive from making requests contains the data
from the multiple requests combined, including the first one. You can also pass
a ``$limit`` as an optional parameter to :php:meth:`Client::paginate()`, which
sets the number of pages to request, assuming they are available. If ``$limit``
is not provided, as many pages as available will be requested.

.. important::

    Not setting the ``$limit`` parameter may cause timeout issues. Be careful of
    how and where you use it.

.. code-block:: php

    use Larabros\Elogram\Client;

    $client   = new Client($clientId, $clientSecret, $accessToken, $redirectUrl);

    // Get initial response
    $response = $client->users()->follows();
    echo json_encode($response->get());

    // Get next two pages of results
    $response = $client->paginate($response, 2);
    echo json_encode($response->get());

    // Get as many pages as available
    $response = $client->paginate($response);
    echo json_encode($response->get());
