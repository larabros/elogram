---------------------------------------------------
Larabros\\Elogram\\Http\\Middleware\\AuthMiddleware
---------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\Middleware

.. php:class:: AuthMiddleware

    A middleware class for authenticating requests made to Instagram's API.

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

    .. php:method:: create(ConfigInterface $config)

        Factory method used to register this middleware on a handler stack.

        :type $config: ConfigInterface
        :param $config:
        :returns: Closure

    .. php:method:: __construct($nextHandler, ConfigInterface $config)

        Creates an instance of :php:class:`AbstractMiddleware`.

        :param $nextHandler:
        :type $config: ConfigInterface
        :param $config:
