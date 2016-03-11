----------------------------------------------------------
Larabros\\Elogram\\Http\\Middleware\\CreateMiddlewareTrait
----------------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\Middleware

.. php:trait:: CreateMiddlewareTrait

    A trait for creating callables for registering middleware on a handler stack.

    .. php:method:: create(ConfigInterface $config)

        Factory method used to register this middleware on a handler stack.

        :type $config: ConfigInterface
        :param $config:
        :returns:  :php:class:`Closure`
