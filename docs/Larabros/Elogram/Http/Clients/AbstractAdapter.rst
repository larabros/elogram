-------------------------------------------------
Larabros\\Elogram\\Http\\Clients\\AbstractAdapter
-------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\Clients

.. php:class:: AbstractAdapter

    An abstract HTTP client adapter.

    .. php:method:: request($method, $uri, $parameters = [])

        {@inheritDoc}

        :param $method:
        :param $uri:
        :param $parameters:

    .. php:method:: paginate(Response $response, $limit = null)

        {@inheritDoc}

        :type $response: Response
        :param $response:
        :param $limit:

    .. php:method:: resolveExceptionClass(ClientException $exception)

        Parses a ``ClientException`` for any specific exceptions thrown by the
        API in the response body. If the response body is not in JSON format,
        an ``Exception`` is returned.

        Check a ``ClientException`` to see if it has an associated
        ``ResponseInterface`` object.

        :type $exception: ClientException
        :param $exception:
        :returns:  :php:class:`Exception`
