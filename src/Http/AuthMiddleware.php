<?php

namespace Instagram\Http;

use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\RequestInterface;

class AuthMiddleware
{
    protected $nextHandler;
    protected $token;

    public function __construct(callable $nextHandler, AccessToken $token)
    {
        $this->nextHandler = $nextHandler;
        $this->token       = $token;
    }

    public function __invoke(RequestInterface $request, array $options)
    {
        // Get the request URL and break it into its parts.
        $request = $request->withQueryParams(['token' => $this->token->getToken()]);
        return $this->nextHandler($request, $options);
    }

    public static function add(AccessToken $token)
    {
        return function (callable $handler) use ($token) {
            return new static($handler, $token);
        };
    }
}