<?php

namespace Instagram\Http\Middleware;

use GuzzleHttp\Psr7\Uri;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\RequestInterface;

final class AuthMiddleware
{
    /**
     * The next handler in the stack.
     *
     * @var callable
     */
    protected $nextHandler;

    /**
     * The access token used to authenticate requests.
     *
     * @var AccessToken
     */
    protected $token;

    /**
     * Creates an instance of `AuthMiddleware`.
     *
     * @param callable $nextHandler
     * @param AccessToken $token
     *
     * @see AuthMiddleware::create()
     */
    private function __construct(callable $nextHandler, AccessToken $token)
    {
        $this->nextHandler = $nextHandler;
        $this->token       = $token;
    }

    /**
     * Execute the middleware.
     *
     * @param RequestInterface $request
     * @param array $options
     * @return mixed
     */
    public function __invoke(RequestInterface $request, array $options)
    {
        $uri     = Uri::withQueryValue($request->getUri(), 'access_token', $this->token->getToken());
        $request = $request->withUri($uri)->withHeader('Content-Type', 'application/json');

        return call_user_func_array($this->nextHandler, [$request, $options]);
    }

    /**
     * Factory method used to register this class on a handler stack.
     *
     * @param AccessToken $token
     * @return \Closure
     */
    public static function create(AccessToken $token)
    {
        return function (callable $handler) use ($token) {
            return new static($handler, $token);
        };
    }
}