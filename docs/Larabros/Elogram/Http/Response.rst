---------------------------------
Larabros\\Elogram\\Http\\Response
---------------------------------

.. php:namespace: Larabros\\Elogram\\Http

.. php:class:: Response

    Represents a response returned from the API.

    .. php:attr:: raw

        protected array

    .. php:attr:: meta

        protected array

    .. php:attr:: data

        protected array

    .. php:attr:: pagination

        protected array

    .. php:method:: __construct($meta = [], $data = [], $pagination = [])

        Creates a new instance of :php:class:`Response`.

        :type $meta: array
        :param $meta:
        :type $data: array
        :param $data:
        :type $pagination: array
        :param $pagination:

    .. php:method:: createFromJson($response)

        Creates a new instance of :php:class:`Response` from a JSON-decoded
        response body.

        :type $response: array
        :param $response:
        :returns:  :php:class:`static`

    .. php:method:: getRaw($key = null)

        Gets the JSON-decoded raw response.

        :type $key: string|null
        :param $key:
        :returns:  :php:class:`array`

    .. php:method:: get()

        Gets the response body. If the response contains multiple records,
        a ``Collection`` is returned.

        :returns:  :php:class:`array|Collection`

    .. php:method:: merge(Response $response)

        Merges the contents of this response with ``$response`` and returns a new
        :php:class:`Response` instance.

        :type $response: Response
        :param $response:
        :returns:  :php:class:`Response`

    .. php:method:: isCollection($data)

        Tests the current response data to see if one or more records were
        returned.

        :type $data: array|Collection
        :param $data:
        :returns:  :php:class:`bool`

    .. php:method:: isRecord($data)

        Tests the current response data to see if a single record was returned.

        :type $data: array|Collection
        :param $data:
        :returns:  :php:class:`bool`

    .. php:method:: hasPages()

        If the response has a ``pagination`` field with a ``next_url`` key, then
        returns ``true``, otherwise ``false``.

        :returns:  :php:class:`bool`

    .. php:method:: nextUrl()

        Returns the next URL, if available, otherwise ``null``.

        :returns:  :php:class:`string|null`

    .. php:method:: __toString()

        Returns the JSON-encoded raw response.

        :returns:  :php:class:`string`
