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

        Returns the current instance of :php:class:`UsersRepository`.

        :returns: UsersRepository

    .. php:method:: media()

        Returns the current instance of :php:class:`MediaRepository`.

        :returns: MediaRepository

    .. php:method:: comments()

        Returns the current instance of :php:class:`CommentsRepository`.

        :returns: CommentsRepository

    .. php:method:: likes()

        Returns the current instance of :php:class:`LikesRepository`.

        :returns: LikesRepository

    .. php:method:: tags()

        Returns the current instance of :php:class:`TagsRepository`.

        :returns: TagsRepository

    .. php:method:: locations()

        Returns the current instance of :php:class:`LocationsRepository`.

        :returns: LocationsRepository

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
        :returns: unknown void

    .. php:method:: secureRequests($enable = true)

        Enables or disables secure requests by adding or removing
        `SecureRequestMiddleware`.

        :type $enable: bool
        :param $enable:
        :returns: unknown void
