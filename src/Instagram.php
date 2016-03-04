<?php

namespace Instagram;

use Instagram\Container\Builder;
use Instagram\Entities\Comment;
use Instagram\Entities\LikeRepository;
use Instagram\Entities\Location;
use Instagram\Entities\Media;
use Instagram\Entities\Tag;
use Instagram\Entities\User;
use Instagram\Helpers\LoginHelperInterface;
use Instagram\Http\Client\AdapterInterface;
use Instagram\Http\Response;
use Instagram\Providers\EntityServiceProvider;
use Instagram\Providers\HttpServiceProvider;
use League\Container\Container;

/**
 * Instagram class.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
final class Instagram
{

    /**
     * A list of default provider classes
     *
     * @var array
     */
    protected $defaultProviders = [
        HttpServiceProvider::class,
        EntityServiceProvider::class,
    ];

    /**
     * The application IoC container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create an instance of `Instagram`.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param null   $accessToken
     * @param string $redirectUrl
     * @param array  $providers
     */
    public function __construct(
        $clientId,
        $clientSecret,
        $accessToken = null,
        $redirectUrl = '',
        $providers = []
    ) {
        $this->container = $this->buildContainer(
            $clientId,
            $clientSecret,
            $accessToken,
            $redirectUrl
        );
    }

    /**
     * Takes the constructor parameters and uses them to instantiate and build a
     * `Container` object.
     *
     * @param string      $clientId
     * @param string      $clientSecret
     * @param string|null $accessToken
     * @param string      $redirectUrl
     * @param array       $providers
     *
     * @return \League\Container\ContainerInterface
     */
    protected function buildContainer(
        $clientId,
        $clientSecret,
        $accessToken = null,
        $redirectUrl = '',
        $providers = []
    ) {
        return (new Builder([
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'access_token'  => $accessToken,
            'redirect_url'  => $redirectUrl,
        ]))->register($this->getProviders($providers))
            ->getContainer();
    }

    /**
     * @param array $providers
     *
     * @return array
     */
    protected function getProviders(array $providers)
    {
        return array_merge($this->defaultProviders, $providers);
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->container->get('config');
    }

    /**
     * @return LoginHelperInterface
     */
    public function getLoginHelper()
    {
        return $this->container->get('helper');
    }

    /**
     * @return AdapterInterface
     */
    public function getClient()
    {
        return $this->container->get('http');
    }

    /***************
     *
     * API methods
     *
     ***************
     */

    /**
     * Returns the current instance of `User`.
     *
     * @return User
     */
    public function users()
    {
        return $this->container->get('entity.user');
    }

    /**
     * Returns the current instance of `Media`.
     *
     * @return Media
     */
    public function media()
    {
        return $this->container->get('entity.media');
    }

    /**
     * Returns the current instance of `Comment`.
     *
     * @return Comment
     */
    public function comments()
    {
        return $this->container->get('entity.comment');
    }

    /**
     * Returns the current instance of `LikeRepository`.
     *
     * @return LikeRepository
     */
    public function likes()
    {
        return $this->container->get('entity.like');
    }

    /**
     * Returns the current instance of `Tag`.
     *
     * @return Tag
     */
    public function tags()
    {
        return $this->container->get('entity.tag');
    }

    /**
     * Returns the current instance of `Location`.
     *
     * @return Location
     */
    public function locations()
    {
        return $this->container->get('entity.location');
    }

    /***************
     *
     * Helper methods
     *
     ****************/

    /**
     * Paginates a `Response`. The pagination limit is set by `$limit`,
     * setting it to `null` will paginate as far as possible.
     *
     * @param Response $response
     * @param int      $limit
     *
     * @return Response
     */
    public function paginate(Response $response, $limit = null)
    {
        return $this->getClient()->paginate($response, $limit);
    }
}
