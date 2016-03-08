<?php

namespace Larabros\Elogram;

use GuzzleHttp\HandlerStack;
use Larabros\Elogram\Container\Builder;
use Larabros\Elogram\Entities\Comment;
use Larabros\Elogram\Entities\LikeRepository;
use Larabros\Elogram\Entities\Location;
use Larabros\Elogram\Entities\Media;
use Larabros\Elogram\Entities\Tag;
use Larabros\Elogram\Entities\User;
use Larabros\Elogram\Helpers\RedirectLoginHelper;
use Larabros\Elogram\Http\Clients\AdapterInterface;
use Larabros\Elogram\Http\Response;
use League\Container\ContainerInterface;
use League\OAuth2\Client\Token\AccessToken;
use Noodlehaus\ConfigInterface;

/**
 * Elogram client class.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/elogram-sdk
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
     * Create an instance of `Client`.
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
     * `Container` object.
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

    /**
     *
     * Request methods
     *
     */

    /**
     * Sends a request and returns a `Response` instance.
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
     * Paginates a `Response` and returns a new `Response` instance.
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
     * @codeCoverageIgnore
     */
    public function setAccessToken(AccessToken $token)
    {
        $this->container->get('config')
            ->set('access_token', json_encode($token));
        $stack = $this->container->get(HandlerStack::class);
        $stack->push($this->container->get("middleware.auth"), 'auth');
    }

    /**
     * Enables or disables secure requests by adding or removing
     * `SecureRequestMiddleware`.
     *
     * @param bool $enable
     *
     * @codeCoverageIgnore
     */
    public function secureRequests($enable = true)
    {
        $this->container->get('config')
            ->set('secure_requests', $enable);
    }
}
