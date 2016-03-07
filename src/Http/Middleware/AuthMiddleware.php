<?php

namespace Instagram\Http\Middleware;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;

/**
 * A middleware class for authenticating requests made to Instagram's API.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
final class AuthMiddleware extends AbstractMiddleware
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(RequestInterface $request, array $options)
    {
        $next = $this->nextHandler;

        if (
            !$this->config->has('access_token')
            || $this->config->get('access_token') === null
        ) {
            return $next($request, $options);
        }

        $uri = Uri::withQueryValue(
            $request->getUri(),
            'access_token',
            $this->config->get('access_token')->getToken()
        );

        return parent::__invoke(
            $request->withUri($uri)->withHeader('Content-Type', 'application/json'),
            $options
        );
    }
}
