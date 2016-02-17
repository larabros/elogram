<?php

namespace Instagram\Providers;

use GuzzleHttp\Client as GuzzleClient;
use Instagram\Client;
use Instagram\Helpers\SessionLoginHelper;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\OAuth2\Client\Provider\Instagram;
use League\OAuth2\Client\Token\AccessToken;

/**
 * HttpServiceProvider
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class HttpServiceProvider extends AbstractServiceProvider
{
    /**
     * The provides array is a way to let the container
     * know that a service is provided by this service
     * provider. Every service that is registered via
     * this service provider must have an alias added
     * to this array or it will be ignored.
     *
     * @var array
     */
    protected $provides = [
        'provider',
        'helper',
        'http',
    ];

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        $config = $this->getContainer()->get('config');

        $this->getContainer()->add('provider', Instagram::class)
            ->withArgument([
                'clientId'     => $config->get('client_id'),
                'clientSecret' => $config->get('client_secret'),
                'redirectUri'  => $config->get('redirect_url'),
            ]);

        $this->getContainer()->add('helper', SessionLoginHelper::class)
            ->withArgument($this->getContainer()->get('provider'));

        // Check if provided, then set, otherwise not
        $this->getContainer()->add('http', Client::class)
//            ->withArgument(new AccessToken(json_decode($config->get('access_token'), true)))
            ->withArgument(new GuzzleClient(['base_uri' => $config->get('base_uri')]));
    }
}