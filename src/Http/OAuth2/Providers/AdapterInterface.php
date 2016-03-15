<?php

namespace Larabros\Elogram\Http\OAuth2\Providers;

use League\OAuth2\Client\Token\AccessToken;

/**
 * An interface for OAuth2 providers.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
interface AdapterInterface
{
    /**
     * Builds the authorization URL.
     *
     * @param  array $options
     *
     * @return string Authorization URL
     */
    public function getAuthorizationUrl(array $options = []);

    /**
     * Requests an access token using a specified grant and option set.
     *
     * @param  mixed $grant
     * @param  array $options
     *
     * @return AccessToken
     */
    public function getAccessToken($grant, array $options = []);
}
