<?php

namespace Larabros\Elogram\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Larabros\Elogram\Http\Clients\AdapterInterface;
use Larabros\Elogram\Http\Clients\GuzzleAdapter;
use Larabros\Elogram\Http\Clients\MockAdapter;
use League\Container\Argument\RawArgument;
use League\Container\ServiceProvider\AbstractServiceProvider;

/**
 * Adds Guzzle to the project.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
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
        Client::class,
        AdapterInterface::class,
    ];

    /**
     * Use the register method to register items with the container via the
     * protected ``$this->container`` property or the ``getContainer`` method
     * from the ``ContainerAwareTrait``.
     *
     * @return void
     */
    public function register()
    {
        $container = $this->getContainer();
        $config    = $container->get('config');

        $container->share(Client::class)
            ->withArgument(new RawArgument([
                'base_uri' => $config->get('base_uri'),
                'handler'  => $container->get(HandlerStack::class),
            ]));

        if ($config->get('http_adapter') === GuzzleAdapter::class) {
            $container->share(AdapterInterface::class, function () use ($container) {
                return new GuzzleAdapter($container->get(Client::class));
            });
        }

        if ($config->get('http_adapter') === MockAdapter::class) {
            $path = realpath(__DIR__.'/../../tests/fixtures').'/';
            $container->share(AdapterInterface::class, new MockAdapter($path));
        }
    }
}
