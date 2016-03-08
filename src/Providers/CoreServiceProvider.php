<?php

namespace Larabros\Elogram\Providers;

use Larabros\Elogram\Helpers\RedirectLoginHelper;
use Larabros\Elogram\Http\Sessions\DataStoreInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\OAuth2\Client\Provider\Instagram;

/**
 * CoreServiceProvider
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
        'provider',
        RedirectLoginHelper::class
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

        $container->share('provider', function () use ($config) {
            return new Instagram([
                'clientId'     => $config->get('client_id'),
                'clientSecret' => $config->get('client_secret'),
                'redirectUri'  => $config->get('redirect_url'),
            ]);
        });

        $container->share(DataStoreInterface::class, function () use ($config) {
            $class = $config->get('session_store');
            return new $class();
        });

        $container->share(RedirectLoginHelper::class, function () use ($container) {
            return new RedirectLoginHelper(
                $container->get('provider'),
                $container->get(DataStoreInterface::class)
            );
        });
    }
}
