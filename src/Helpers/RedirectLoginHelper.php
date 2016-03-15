<?php

namespace Larabros\Elogram\Helpers;

use Larabros\Elogram\Exceptions\CsrfException;
use Larabros\Elogram\Http\OAuth2\Providers\AdapterInterface;
use Larabros\Elogram\Http\Sessions\DataStoreInterface;
use League\OAuth2\Client\Token\AccessToken;

/**
 * RedirectLoginHelper
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
class RedirectLoginHelper
{
    /**
     * @var AdapterInterface
     */
    protected $provider;

    /**
     * @var DataStoreInterface
     */
    protected $store;

    /**
     * Creates an instance of :php:class:`RedirectLoginHelper`.
     *
     * @param AdapterInterface $provider
     * @param DataStoreInterface $store
     */
    public function __construct(AdapterInterface $provider, DataStoreInterface $store)
    {
        $this->provider = $provider;
        $this->store    = $store;
    }

    /**
     * Sets CSRF value and returns the login URL.
     *
     * @param array $options
     *
     * @return string
     *
     * @see League\OAuth2\Client\Provider\AbstractProvider::getAuthorizationUrl()
     */
    public function getLoginUrl(array $options = [])
    {
        $url = $this->provider->getAuthorizationUrl($options);
        $this->store->set('oauth2state', $this->provider->getState());
        return $url;
    }

    /**
     * Validates CSRF and returns the access token.
     *
     * @param string $code
     * @param string $grant
     *
     * @return AccessToken
     *
     * @see League\OAuth2\Client\Provider\AbstractProvider::getAccessToken()
     */
    public function getAccessToken($code, $grant = 'authorization_code')
    {
        $this->validateCsrf();
        return $this->provider->getAccessToken($grant, ['code' => $code]);
    }

    /**
     * Validates any CSRF parameters.
     *
     * @throws CsrfException
     */
    protected function validateCsrf()
    {
        if (empty($this->getInput('state'))
            || ($this->getInput('state') !== $this->store->get('oauth2state'))
        ) {
            $this->store->set('oauth2state', null);
            throw new CsrfException('Invalid state');
        }
        return;
    }

    /**
     * Retrieves and returns a value from a GET param.
     *
     * @param string $key
     *
     * @return string|null
     */
    protected function getInput($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }
}
