<?php

namespace Elogram\Providers;

use GuzzleHttp\HandlerStack;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\OAuth2\Client\Token\AccessToken;

/**
 * MiddlewareServiceProvider
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/elogram-sdk
 * @license    MIT
 */
class MiddlewareServiceProvider extends AbstractServiceProvider
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

        $container->share(HandlerStack::class, function () {
            return HandlerStack::create();
        });

        // If access token was provided, then instantiate and add to middleware
        if ($config->has('access_token')
            && $config->get('access_token') !== null
        ) {

            // Convert the JSON serialized token into an `AccessToken` instance.
            $config->set(
                'access_token',
                new AccessToken(json_decode($config->get('access_token'), true))
            );

            foreach ($config->get('middleware') as $name => $class) {
                $container->add("middleware.$name", function () use ($class, $config) {
                    return $class::create($config);
                });
            }
        }

        $this->addMiddleware();
    }

    protected function addMiddleware()
    {
        $container = $this->getContainer();
        $config    = $container->get('config');
        $stack     = $container->get(HandlerStack::class);

        foreach ($config->get('middleware') as $name => $item) {
            $stack->push($container->get("middleware.$name"), $name);
        }
    }
}
