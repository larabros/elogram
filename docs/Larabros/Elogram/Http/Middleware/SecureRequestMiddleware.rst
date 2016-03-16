------------------------------------------------------------
Larabros\\Elogram\\Http\\Middleware\\SecureRequestMiddleware
------------------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\Middleware

.. php:class:: SecureRequestMiddleware

    A middleware class for making secure requests to Instagram's API.

    .. php:attr:: nextHandler

        protected callable

        The next handler in the stack.

    .. php:attr:: config

        protected ConfigInterface

        The application configuration.

    .. php:method:: __invoke(RequestInterface $request, $options)

        {@inheritDoc}

        :type $request: RequestInterface
        :param $request:
        :param $options:

    .. php:method:: generateSig($endpoint, $params, $secret)

        Generates a ``sig`` value for a request.

        :param $endpoint:
        :param $params:
        :param $secret:
        :returns: string

    .. php:method:: create(ConfigInterface $config)

        Factory method used to register this middleware on a handler stack.

        :type $config: ConfigInterface
        :param $config:
        :returns: Closure

    .. php:method:: getPath(UriInterface $uri)

        Gets the path from a ``UriInterface`` instance after removing the version
        prefix.

        :type $uri: UriInterface
        :param $uri:
        :returns: string

    .. php:method:: getQueryParams(UriInterface $uri, $exclude = ['sig'], $params = [])

        Gets the query parameters as an array from a ``UriInterface`` instance.

        :type $uri: UriInterface
        :param $uri:
        :type $exclude: array
        :param $exclude:
        :type $params: array
        :param $params:
        :returns: array

    .. php:method:: __construct($nextHandler, ConfigInterface $config)

        Creates an instance of :php:class:`AbstractMiddleware`.

        :param $nextHandler:
        :type $config: ConfigInterface
        :param $config:
