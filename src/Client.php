<?php

namespace Larabros\Elogram;

use GuzzleHttp\HandlerStack;
use Larabros\Elogram\Container\Builder;
use Larabros\Elogram\Repositories\CommentsRepository;
use Larabros\Elogram\Repositories\LikesRepository;
use Larabros\Elogram\Repositories\LocationsRepository;
use Larabros\Elogram\Repositories\MediaRepository;
use Larabros\Elogram\Repositories\TagsRepository;
use Larabros\Elogram\Repositories\UsersRepository;
use Larabros\Elogram\Helpers\RedirectLoginHelper;
use Larabros\Elogram\Http\Clients\AdapterInterface;
use Larabros\Elogram\Http\Response;
use League\Container\ContainerInterface;
use League\OAuth2\Client\Token\AccessToken;

/**
 * Elogram client class.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
final class Client
{
    /**
     * The current version of the API.
     */
    const API_VERSION = 1;

    /**
     * The application IoC container.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Create an instance of :php:class:`Client`.
     *
     * @param string        $clientId
     * @param string        $clientSecret
     * @param string|null   $accessToken
     * @param string        $redirectUrl
     * @param array         $options
     */
    public function __construct(
        $clientId,
        $clientSecret,
        $accessToken = null,
        $redirectUrl = '',
        array $options = []
    ) {
        $this->container = $this->buildContainer(array_merge([
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'access_token'  => $accessToken,
            'redirect_url'  => $redirectUrl,
        ], $options));
    }

    /**
     * Takes the constructor parameters and uses them to instantiate and build a
     * ``Container`` object.
     *
     * @param array       $options
     *
     * @return ContainerInterface
     */
    protected function buildContainer(array $options)
    {
        return (new Builder($options))->getContainer();
    }

    /**
     *
     * API methods
     *
     */

    /**
     * Returns the current instance of :php:class:`UsersRepository`.
     *
     * @return UsersRepository
     */
    public function users()
    {
        return $this->container->get('repo.user');
    }

    /**
     * Returns the current instance of :php:class:`MediaRepository`.
     *
     * @return MediaRepository
     */
    public function media()
    {
        return $this->container->get('repo.media');
    }

    /**
     * Returns the current instance of :php:class:`CommentsRepository`.
     *
     * @return CommentsRepository
     */
    public function comments()
    {
        return $this->container->get('repo.comment');
    }

    /**
     * Returns the current instance of :php:class:`LikesRepository`.
     *
     * @return LikesRepository
     */
    public function likes()
    {
        return $this->container->get('repo.like');
    }

    /**
     * Returns the current instance of :php:class:`TagsRepository`.
     *
     * @return TagsRepository
     */
    public function tags()
    {
        return $this->container->get('repo.tag');
    }

    /**
     * Returns the current instance of :php:class:`LocationsRepository`.
     *
     * @return LocationsRepository
     */
    public function locations()
    {
        return $this->container->get('repo.location');
    }

    /**
     *
     * Request methods
     *
     */

    /**
     * Sends a request.
     *
     * @param string $method
     * @param string $uri
     * @param array  $parameters
     *
     * @return Response
     *
     * @see Elogram\Http\Clients\AdapterInterface::request()
     *
     * @codeCoverageIgnore
     */
    public function request($method, $uri, array $parameters = [])
    {
        return $this->container->get(AdapterInterface::class)
            ->request($method, $uri, $parameters);
    }

    /**
     * Paginates a :php:class:`Response`.
     *
     * @param Response  $response
     * @param int|null  $limit
     *
     * @return Response
     *
     * @see Elogram\Http\Clients\AdapterInterface::paginate()
     *
     * @codeCoverageIgnore
     */
    public function paginate(Response $response, $limit = null)
    {
        return $this->container->get(AdapterInterface::class)
            ->paginate($response, $limit);
    }

    /**
     *
     * Helper methods
     *
     */

    /**
     * Gets the login URL.
     *
     * @param array $options
     *
     * @return string
     *
     * @see Elogram\Helpers\RedirectLoginHelper::getLoginUrl()
     *
     * @codeCoverageIgnore
     */
    public function getLoginUrl(array $options = [])
    {
        return $this->container->get(RedirectLoginHelper::class)
            ->getLoginUrl($options);
    }

    /**
     * Sets and returns the access token.
     *
     * @param string $code
     * @param string $grant
     *
     * @return AccessToken
     *
     * @see Elogram\Helpers\RedirectLoginHelper::getAccessToken()
     *
     * @codeCoverageIgnore
     */
    public function getAccessToken($code, $grant = 'authorization_code')
    {
        $token = $this->container->get(RedirectLoginHelper::class)
            ->getAccessToken($code, $grant);
        $this->setAccessToken($token);
        return $token;
    }

    /**
     * Sets an access token and adds it to `AuthMiddleware` so the application
     * can make authenticated requests.
     *
     * @param AccessToken $token
     *
     * @return  void
     *
     * @codeCoverageIgnore
     */
    public function setAccessToken(AccessToken $token)
    {
        $this->container->get('config')
            ->set('access_token', $token);
    }

    /**
     * Enables or disables secure requests by adding or removing
     * `SecureRequestMiddleware`.
     *
     * @param bool $enable
     *
     * @return  void
     *
     * @codeCoverageIgnore
     */
    public function secureRequests($enable = true)
    {
        $this->container->get('config')
            ->set('secure_requests', $enable);
    }
}
