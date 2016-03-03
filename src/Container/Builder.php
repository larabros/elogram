<?php

namespace Instagram\Container;

use Instagram\Config;
use Instagram\Providers\EntityServiceProvider;
use Instagram\Providers\HttpServiceProvider;
use League\Container\Container;
use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use League\Container\ContainerInterface;
use League\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Builder class.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * Default application service providers.
     *
     * @var array
     */
    protected $defaultProviders = [
        HttpServiceProvider::class,
        EntityServiceProvider::class,
    ];

    /**
     * Creates a new instance of `Builder`.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->setContainer($this->createContainer($config));
        $this->createConfig($this->getContainer()->get('config.raw'));
    }

    /**
     * Creates a `Config` object from raw parameters.
     *
     * @param array $config
     *
     * @return Config
     */
    protected function createConfig(array $config)
    {
        $this->getContainer()->share('config', new Config($config));
    }

    /**
     * Registers service providers onto the container. This method can be passed
     * an array, a string or a `ServiceProviderInterface`.
     *
     * @param array|string|ServiceProviderInterface $provider
     *
     * @return $this
     */
    public function register($provider)
    {
        if (!is_array($provider) || $provider instanceof ServiceProviderInterface) {
            $this->getContainer()->addServiceProvider($provider);
            return $this;
        }

        foreach($provider as $aProvider) {
            $this->register($aProvider);
        }
        return $this;
    }

    /**
     * Creates and returns a new `Container` instance after adding the raw
     * config values to it.
     *
     * @param array $config
     *
     * @return ContainerInterface
     */
    public function createContainer(array $config)
    {
        $container = new Container();
        $container->add('config.raw', $config);
        $this->setContainer($container);
        return $this->getContainer();
    }
}