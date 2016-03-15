-----------------------------------------------------
Larabros\\Elogram\\Http\\Sessions\\DataStoreInterface
-----------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\Sessions

.. php:interface:: DataStoreInterface

    Defines an interface for getting and setting values from a data store.

    .. php:method:: get($key)

        Get a value from a data store.

        :type $key: string
        :param $key:
        :returns: mixed

    .. php:method:: set($key, $value)

        Set a value in the data store.

        :type $key: string
        :param $key:
        :param $value:
        :returns: unknown void
