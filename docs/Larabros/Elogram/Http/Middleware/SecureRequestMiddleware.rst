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

    .. php:method:: getPath($path)

        :param $path:

    .. php:method:: getParams($query)

        :param $query:

    .. php:method:: generateSig($endpoint, $params, $secret)

        :param $endpoint:
        :param $params:
        :param $secret:

    .. php:method:: create(ConfigInterface $config)

        Factory method used to register this middleware on a handler stack.

        :type $config: ConfigInterface
        :param $config:
        :returns:  :php:class:`Closure`

    .. php:method:: __construct($nextHandler, ConfigInterface $config)

        Creates an instance of :php:class:`AbstractMiddleware`.

        :param $nextHandler:
        :type $config: ConfigInterface
        :param $config:
