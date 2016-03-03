<?php

namespace Instagram\Providers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use Instagram\Client;
use Instagram\Helpers\SessionLoginHelper;
use Instagram\Http\Client\GuzzleAdapter;
use Instagram\Http\Middleware\AuthMiddleware;
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
        $container = $this->getContainer();
        $config    = $container->get('config');

        $container->share('provider', function() use ($config) {
            return new Instagram([
                'clientId'     => $config->get('client_id'),
                'clientSecret' => $config->get('client_secret'),
                'redirectUri'  => $config->get('redirect_url'),
            ]);
        });

        $container->share('helper', function() use ($container) {
            return new SessionLoginHelper($container->get('provider'));
        });

        // If access token is set and valid, then create handler stack and set access token
        // on client

        // Check if access token was provided, then set, otherwise not
        if ($config->has('access_token')) {

            $container->share('http', function() use ($config) {

                $stack = HandlerStack::create();
                $stack->push(AuthMiddleware::create($config->get('access_token')));

                return new GuzzleAdapter(new GuzzleClient([
                    'base_uri' => $config->get('base_uri'),
                    'handler'  => $stack,
                ]));
            });
        }
    }
}