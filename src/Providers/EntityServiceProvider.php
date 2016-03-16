<?php

namespace Larabros\Elogram\Providers;

use Larabros\Elogram\Repositories\CommentsRepository;
use Larabros\Elogram\Repositories\LikesRepository;
use Larabros\Elogram\Repositories\LocationsRepository;
use Larabros\Elogram\Repositories\MediaRepository;
use Larabros\Elogram\Repositories\TagsRepository;
use Larabros\Elogram\Repositories\UsersRepository;
use Larabros\Elogram\Http\Clients\AdapterInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

/**
 * Adds repository classes to the container.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
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
        'repo.user',
        'repo.media',
        'repo.comment',
        'repo.like',
        'repo.tag',
        'repo.location',
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
        $adapter = $this->getContainer()->get(AdapterInterface::class);
        $this->getContainer()->share('repo.user', new UsersRepository($adapter));
        $this->getContainer()->share('repo.media', new MediaRepository($adapter));
        $this->getContainer()->share('repo.comment', new CommentsRepository($adapter));
        $this->getContainer()->share('repo.like', new LikesRepository($adapter));
        $this->getContainer()->share('repo.tag', new TagsRepository($adapter));
        $this->getContainer()->share('repo.location', new LocationsRepository($adapter));
    }
}
