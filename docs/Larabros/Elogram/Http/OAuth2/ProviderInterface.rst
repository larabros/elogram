--------------------------------------------------
Larabros\\Elogram\\Http\\OAuth2\\ProviderInterface
--------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\OAuth2

.. php:interface:: ProviderInterface

    An interface for OAuth2 providers.

    .. php:method:: getAuthorizationUrl($options = [])

        Builds the authorization URL.

        :param $options:
        :returns:  :php:class:`string` Authorization URL

    .. php:method:: getAccessToken($grant, $options = [])

        Requests an access token using a specified grant and option set.

        :param $grant:
        :param $options:
        :returns:  :php:class:`AccessToken`
