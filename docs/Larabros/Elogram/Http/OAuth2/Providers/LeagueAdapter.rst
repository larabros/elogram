---------------------------------------------------------
Larabros\\Elogram\\Http\\OAuth2\\Providers\\LeagueAdapter
---------------------------------------------------------

.. php:namespace: Larabros\\Elogram\\Http\\OAuth2\\Providers

.. php:class:: LeagueAdapter

    An OAuth2 provider for the League Instagram OAuth2 package.

    .. php:method:: getAuthorizationUrl($options = [])

        Builds the authorization URL.

        :param $options:
        :returns: string Authorization URL

    .. php:method:: getAccessToken($grant, $options = [])

        Requests an access token using a specified grant and option set.

        :param $grant:
        :param $options:
        :returns: AccessToken
