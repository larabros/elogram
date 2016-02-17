<?php

namespace Instagram\Providers;

use Instagram\Entities\Media;
use Instagram\Entities\User;
use League\Container\ServiceProvider\AbstractServiceProvider;

class EntityServiceProvider extends AbstractServiceProvider
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
        'entity.user',
        'entity.media',
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
        $this->getContainer()->add('entity.user', User::class)
            ->withArgument($this->getContainer()->get('http'));

        $this->getContainer()->add('entity.media', Media::class)
            ->withArgument($this->getContainer()->get('http'));
    }
}