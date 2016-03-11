-------------------------------------------------------
Larabros\\Elogram\\Http\\Middleware\\AbstractMiddleware
-------------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\Middleware

.. php:class:: AbstractMiddleware

    An abstract middleware class.

    .. php:attr:: nextHandler

        protected callable

        The next handler in the stack.

    .. php:attr:: config

        protected ConfigInterface

        The application configuration.

    .. php:method:: __construct($nextHandler, ConfigInterface $config)

        Creates an instance of :php:class:`AbstractMiddleware`.

        :param $nextHandler:
        :type $config: ConfigInterface
        :param $config:

    .. php:method:: __invoke(RequestInterface $request, $options)

        {@inheritDoc}

        :type $request: RequestInterface
        :param $request:
        :param $options:
