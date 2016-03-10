-------------------------------------
Larabros\\Elogram\\Container\\Builder
-------------------------------------

.. php:namespace: Larabros\\Elogram\\Container

.. php:class:: Builder

    Builds ``Container`` objects for use by the application.

    .. php:attr:: defaultProviders

        protected array

        Default application service providers.

    .. php:method:: __construct($config, $registerProviders = true)

        Creates a new instance of :php:class:`Builder`.

        :type $config: array
        :param $config:
        :param $registerProviders:

    .. php:method:: createConfig($config)

        Creates a :php:class:`Config` object from raw parameters.

        :type $config: array
        :param $config:
        :returns: Config

    .. php:method:: registerProviders($providers = [])

        Register default service providers onto the container.

        :type $providers: array
        :param $providers:
        :returns: Builder

    .. php:method:: registerProvider($provider)

        Registers a service provider onto the container.

        :type $provider: string|ServiceProviderInterface
        :param $provider:
        :returns: Builder

    .. php:method:: createContainer($config)

        Creates and returns a new instance of ``Container`` after adding
        ``$config`` to it.

        :type $config: array
        :param $config:
        :returns: ContainerInterface
