<?php

namespace Larabros\Elogram\Providers;

use GuzzleHttp\Client;
use Larabros\Elogram\Helpers\RedirectLoginHelper;
use Larabros\Elogram\Http\OAuth2\Providers\LeagueAdapter;
use Larabros\Elogram\Http\OAuth2\Providers\AdapterInterface;
use Larabros\Elogram\Http\Sessions\DataStoreInterface;
use Larabros\Elogram\Http\Sessions\NativeSessionStore;
use League\Container\ServiceProvider\AbstractServiceProvider;

/**
 * Adds core classes to container.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
class CoreServiceProvider extends AbstractServiceProvider
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
        RedirectLoginHelper::class
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

        $container->share(AdapterInterface::class, function () use ($config, $container) {
            return new LeagueAdapter([
                'clientId'     => $config->get('client_id'),
                'clientSecret' => $config->get('client_secret'),
                'redirectUri'  => $config->get('redirect_url'),
            ], [
                'httpClient' => $container->get(Client::class)
            ]);
        });

        if ($config->get('session_store') === NativeSessionStore::class) {
            $container->share(DataStoreInterface::class, function () {
                return new NativeSessionStore();
            });
        }

        $container->share(RedirectLoginHelper::class, function () use ($container) {
            return new RedirectLoginHelper(
                $container->get(AdapterInterface::class),
                $container->get(DataStoreInterface::class)
            );
        });
    }
}
