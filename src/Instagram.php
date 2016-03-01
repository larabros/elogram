<?php

namespace Instagram;

use Instagram\Entities\Media;
use Instagram\Entities\User;
use Instagram\Helpers\LoginHelperInterface;
use Instagram\Http\Client\AdapterInterface;
use Instagram\Http\Response;
use Instagram\Providers\EntityServiceProvider;
use Instagram\Providers\HttpServiceProvider;
use League\Container\Container;

/**
 * Instagram class.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
final class Instagram
{

    /**
     * A list of default provider classes
     *
     * @var array
     */
    protected $defaultProviders = [
        HttpServiceProvider::class,
        EntityServiceProvider::class,
    ];

    /**
     * The application IoC container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create an instance of `Instagram`.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param null   $accessToken
     * @param string $redirectUrl
     * @param array  $providers
     */
    public function __construct(
        $clientId,
        $clientSecret,
        $accessToken = null,
        $redirectUrl = '',
        $providers = []
    ) {
        $this->container    = new Container();
        $this->container->add(
            'config',
            $this->createConfig($clientId, $clientSecret, $accessToken, $redirectUrl)
        );

        $this->registerServiceProviders($providers);
    }

    /**
     * Creates a `Config` object from raw parameters.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param null   $accessToken
     * @param string $redirectUrl
     *
     * @return Config
     */
    protected function createConfig($clientId, $clientSecret, $accessToken = null, $redirectUrl)
    {
        return new Config([
            'base_url'      => 'https://api.instagram.com/v1/',
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'access_token'  => $accessToken,
            'redirect_url'  => $redirectUrl,
        ]);
    }

    /**
     * @param array $providers
     */
    public function registerServiceProviders(array $providers)
    {
        $newProviders = empty($providers) ? $this->defaultProviders :  $providers;
        foreach($newProviders as $provider) {
            $this->container->addServiceProvider($provider);
        }
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->container->get('config');
    }

    /**
     * @return LoginHelperInterface
     */
    public function getLoginHelper()
    {
        return $this->container->get('helper');
    }

    /**
     * @return AdapterInterface
     */
    public function getClient()
    {
        return $this->container->get('http');
    }

    /***************
     *
     * API methods
     *
     ***************
     */

    /**
     * Returns the current instance of `User`.
     *
     * @return User
     */
    public function users()
    {
        return $this->container->get('entity.user');
    }

    /**
     * @return Media
     */
    public function media()
    {
        return $this->container->get('entity.media');
    }

    /***************
     *
     * Helper methods
     *
     ****************/

    /**
     * Paginates a `Response`. The pagination limit is set by `$limit`,
     * setting it to `null` will paginate as far as possible.
     *
     * @param Response $response
     * @param int      $limit
     * @return mixed
     */
    public function paginate(Response $response, $limit = null)
    {
        return $this->getClient()->paginate($response, $limit);
    }
}
