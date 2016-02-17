<?php

namespace Instagram\Helpers;

use Instagram\Exceptions\CsrfException;
use League\OAuth2\Client\Provider\Instagram as InstagramProvider;
use League\OAuth2\Client\Token\AccessToken;

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
    public function getAccessToken()
    {
        $this->validateCsrf();

        return $this->provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
    }

    /**
     * Sets the CSRF nonce for the session.
     */
    protected function setCsrf()
    {
        $_SESSION['oauth2state'] = $this->provider->getState();
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
    }
}
