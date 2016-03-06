<?php

namespace Instagram\Providers;

use Instagram\Entities\Comment;
use Instagram\Entities\LikeRepository;
use Instagram\Entities\Location;
use Instagram\Entities\Media;
use Instagram\Entities\Tag;
use Instagram\Entities\User;
use Instagram\Http\Clients\AdapterInterface;
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
        'entity.comment',
        'entity.like',
        'entity.tag',
        'entity.location',
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
        $this->getContainer()->share('entity.user',     new User($this->getContainer()->get(AdapterInterface::class)));
        $this->getContainer()->share('entity.media',    new Media($this->getContainer()->get(AdapterInterface::class)));
        $this->getContainer()->share('entity.comment',  new Comment($this->getContainer()->get(AdapterInterface::class)));
        $this->getContainer()->share('entity.like',     new LikeRepository($this->getContainer()->get(AdapterInterface::class)));
        $this->getContainer()->share('entity.tag',      new Tag($this->getContainer()->get(AdapterInterface::class)));
        $this->getContainer()->share('entity.location', new Location($this->getContainer()->get(AdapterInterface::class)));
    }
}