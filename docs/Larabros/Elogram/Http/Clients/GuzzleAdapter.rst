-----------------------------------------------
Larabros\\Elogram\\Http\\Clients\\GuzzleAdapter
-----------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\Clients

.. php:class:: GuzzleAdapter

    A HTTP client adapter for Guzzle.

    .. php:attr:: guzzle

        protected ClientInterface

        The Guzzle client instance.

    .. php:method:: __construct(ClientInterface $guzzle)

        Creates a new instance of :php:class:`GuzzleAdapter`.

        :type $guzzle: ClientInterface
        :param $guzzle:

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
        :returns: Exception
