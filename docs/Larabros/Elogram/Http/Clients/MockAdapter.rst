---------------------------------------------
Larabros\\Elogram\\Http\\Clients\\MockAdapter
---------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\Clients

.. php:class:: MockAdapter

    A mock HTTP client adapter.

    .. php:attr:: fixturesPath

        protected string

    .. php:method:: __construct($fixturesPath)

        Creates a new instance of :php:class:`MockAdapter`.

        :type $fixturesPath: string
        :param $fixturesPath:

    .. php:method:: request($method, $uri, $parameters = [])

        {@inheritDoc}

        :param $method:
        :param $uri:
        :param $parameters:

    .. php:method:: mapRequestToFile($method, $uri, $parameters)

        Parse the correct filename from the request.

        :type $method: string
        :param $method:
        :type $uri: string
        :param $uri:
        :param $parameters:
        :returns: string

    .. php:method:: cleanPath($uri)

        Removes any unwanted suffixes and values from a URL path.

        :param $uri:
        :returns: string

    .. php:method:: mapRequestParameters($parameters)

        Parses any filename properties from the request parameters.

        :param $parameters:
        :returns: string

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
