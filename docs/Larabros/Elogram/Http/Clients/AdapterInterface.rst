--------------------------------------------------
Larabros\\Elogram\\Http\\Clients\\AdapterInterface
--------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\Clients

.. php:interface:: AdapterInterface

    .. php:method:: request($method, $uri, $parameters = [])

        Sends a HTTP request. Use this method as a convenient way of making
        requests with built-in exception-handling.

        :param $method:
        :param $uri:
        :param $parameters:
        :returns: Response

    .. php:method:: paginate(Response $response, $limit = null)

        Paginates a :php:class:`Response`.

        :type $response: Response
        :param $response:
        :param $limit:
        :returns: Response
