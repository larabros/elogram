-------------------------------------------------------
Larabros\\Elogram\\Providers\\MiddlewareServiceProvider
-------------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Providers

.. php:class:: MiddlewareServiceProvider

    Adds any middleware to the project.

    .. php:attr:: provides

        protected array

        The provides array is a way to let the container
        know that a service is provided by this service
        provider. Every service that is registered via
        this service provider must have an alias added
        to this array or it will be ignored.

    .. php:method:: register()

        Use the register method to register items with the container via the
        protected ``$this->container`` property or the ``getContainer`` method
        from the ``ContainerAwareTrait``.

        :returns:  :php:class:`void`

    .. php:method:: addMiddleware()
