<?php

namespace Instagram\Helpers;

interface LoginHelperInterface
{
    /**
     * Sets CSRF nonce and returns the login URL.
     *
     * @return string
     */
    public function getLoginUrl();

    /**
     * Validates CSRF and returns the access token.
     *
     * @return AccessToken
     */
    public function getAccessToken();
}
