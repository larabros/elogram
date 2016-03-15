--------------------------------------------------------
Larabros\\Elogram\\Http\\Middleware\\MiddlewareInterface
--------------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\Middleware

.. php:interface:: MiddlewareInterface

    An interface for PSR-7 compatible middleware.

    .. php:method:: __invoke(RequestInterface $request, $options)

        Execute the middleware.

        :type $request: RequestInterface
        :param $request:
        :type $options: array
        :param $options:
        :returns: mixed
