-----------------------------------------------
Larabros\\Elogram\\Helpers\\RedirectLoginHelper
-----------------------------------------------

.. php:namespace: Larabros\\Elogram\\Helpers

.. php:class:: RedirectLoginHelper

    RedirectLoginHelper

    .. php:attr:: provider

        protected ProviderInterface

    .. php:attr:: store

        protected DataStoreInterface

    .. php:method:: __construct(ProviderInterface $provider, DataStoreInterface $store)

        Creates an instance of :php:class:`RedirectLoginHelper`.

        :type $provider: ProviderInterface
        :param $provider:
        :type $store: DataStoreInterface
        :param $store:

    .. php:method:: getLoginUrl($options = [])

        Sets CSRF value and returns the login URL.

        :type $options: array
        :param $options:
        :returns: string

    .. php:method:: getAccessToken($code, $grant = 'authorization_code')

        Validates CSRF and returns the access token.

        :type $code: string
        :param $code:
        :type $grant: string
        :param $grant:
        :returns: AccessToken

    .. php:method:: validateCsrf()

        Validates any CSRF parameters.

    .. php:method:: getInput($key)

        Retrieves and returns a value from a GET param.

        :type $key: string
        :param $key:
        :returns: string|null
