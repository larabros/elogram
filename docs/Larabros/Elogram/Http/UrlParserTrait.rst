---------------------------------------
Larabros\\Elogram\\Http\\UrlParserTrait
---------------------------------------

.. php:namespace: Larabros\\Elogram\\Http

.. php:trait:: UrlParserTrait

    Adds utility classes for parsing parts of a URL.

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
