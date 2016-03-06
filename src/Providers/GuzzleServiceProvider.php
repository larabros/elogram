<?php

namespace Instagram\Providers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use Instagram\Http\Clients\AdapterInterface;
use Instagram\Http\Clients\GuzzleAdapter;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\OAuth2\Client\Token\AccessToken;

/**
 * GuzzleServiceProvider
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class GuzzleServiceProvider extends AbstractServiceProvider
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
        AdapterInterface::class,
        HandlerStack::class
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

        // If access token was provided, then instantiate and add to middleware
        if ($config->has('access_token')) {

            $container->share(AccessToken::class, function() use ($config) {
                return new AccessToken(json_decode($config->get('access_token'), true));
            });

            $container->add('middleware.auth', function() use ($config, $container) {
                $class  = $config->get('middleware.auth');
                return $class::create($container->get(AccessToken::class));
            });
        }

        $container->share(HandlerStack::class, function() use ($config, $container) {
            $stack = HandlerStack::create();

            foreach($config->get('middleware') as $name => $item) {
                $stack->push($container->get("middleware.$name"), $name);
            }
            return $stack;
        });

        $container->share(AdapterInterface::class, function() use ($config, $container) {
            return new GuzzleAdapter(new GuzzleClient([
                'base_uri' => $config->get('base_uri'),
                'handler'  => $container->get(HandlerStack::class),
            ]));
        });
    }
}
