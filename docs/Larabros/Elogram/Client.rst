-------------------------
Larabros\\Elogram\\Client
-------------------------

.. php:namespace: Larabros\\Elogram

.. php:class:: Client

    Elogram client class.

    .. php:const:: API_VERSION

        The current version of the API.

    .. php:attr:: container

        protected ContainerInterface

        The application IoC container.

    .. php:method:: __construct($clientId, $clientSecret, $accessToken = null, $redirectUrl = '', $options = [])

        Create an instance of :php:class:`Client`.

        :param $clientId:
        :param $clientSecret:
        :param $accessToken:
        :param $redirectUrl:
        :param $options:

    .. php:method:: buildContainer($options)

        Takes the constructor parameters and uses them to instantiate and build a
        ``Container`` object.

        :param $options:
        :returns: ContainerInterface

    .. php:method:: users()

        Returns the current instance of :php:class:`User`.

        :returns: User

    .. php:method:: media()

        Returns the current instance of :php:class:`Media`.

        :returns: Media

    .. php:method:: comments()

        Returns the current instance of :php:class:`Comment`.

        :returns: Comment

    .. php:method:: likes()

        Returns the current instance of :php:class:`LikeRepository`.

        :returns: LikeRepository

    .. php:method:: tags()

        Returns the current instance of :php:class:`Tag`.

        :returns: Tag

    .. php:method:: locations()

        Returns the current instance of :php:class:`Location`.

        :returns: Location

    .. php:method:: request($method, $uri, $parameters = [])

        Sends a request.

        :type $method: string
        :param $method:
        :type $uri: string
        :param $uri:
        :param $parameters:
        :returns: Response

    .. php:method:: paginate(Response $response, $limit = null)

        Paginates a :php:class:`Response`.

        :type $response: Response
        :param $response:
        :param $limit:
        :returns: Response

    .. php:method:: getLoginUrl($options = [])

        Gets the login URL.

        :type $options: array
        :param $options:
        :returns: string

    .. php:method:: getAccessToken($code, $grant = 'authorization_code')

        Sets and returns the access token.

        :type $code: string
        :param $code:
        :type $grant: string
        :param $grant:
        :returns: AccessToken

    .. php:method:: setAccessToken(AccessToken $token)

        Sets an access token and adds it to `AuthMiddleware` so the application
        can make authenticated requests.

        :type $token: AccessToken
        :param $token:

    .. php:method:: secureRequests($enable = true)

        Enables or disables secure requests by adding or removing
        `SecureRequestMiddleware`.

        :type $enable: bool
        :param $enable:
