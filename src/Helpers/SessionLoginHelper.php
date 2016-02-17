<?php

namespace Instagram\Helpers;

use Instagram\Exceptions\CsrfException;
use League\OAuth2\Client\Provider\Instagram as InstagramProvider;

/**
 * SessionLoginHelper
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class SessionLoginHelper implements LoginHelperInterface
{
    /**
     * @var InstagramProvider
     */
    protected $provider;

    /**
     * Creates an instance of `SessionLoginHelper`.
     *
     * @param InstagramProvider $provider
     */
    public function __construct(InstagramProvider $provider)
    {
        $this->provider = $provider;
        session_start();
    }

    /**
     * @inheritDoc
     */
    public function getLoginUrl()
    {
        $this->setCsrf();

        return $this->provider->getAuthorizationUrl();
    }

    /**
     * @inheritDoc
     */
    public function getAccessToken($grant = 'authorization_code', $options = [])
    {
        $this->validateCsrf();

        return $this->provider->getAccessToken($grant, array_merge([
            'code' => $_GET['code']
        ], $options));
    }

    /**
     * Sets the CSRF nonce for the session.
     */
    protected function setCsrf()
    {
        $_SESSION['oauth2state'] = $this->provider->getState();
        return;
    }

    /**
     * Validates any CSRF parameters.
     *
     * @throws CsrfException
     */
    protected function validateCsrf()
    {
        if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            throw new CsrfException('Invalid state');
        }
        return;
    }
}
