<?php

namespace Larabros\Elogram\Http\Middleware;

use GuzzleHttp\Psr7\Uri;
use Larabros\Elogram\Http\UrlParserTrait;
use Psr\Http\Message\RequestInterface;

/**
 * A middleware class for making secure requests to Instagram's API.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
final class SecureRequestMiddleware extends AbstractMiddleware
{
    use CreateMiddlewareTrait, UrlParserTrait;

    /**
     * {@inheritDoc}
     */
    public function __invoke(RequestInterface $request, array $options)
    {
        $next = $this->nextHandler;

        if (!$this->config->get('secure_requests')) {
            return $next($request, $options);
        }

        $uri    = $request->getUri();
        $sig    = $this->generateSig(
            $this->getPath($uri),
            $this->getQueryParams($uri),
            $this->config->get('client_secret')
        );
        $uri    = Uri::withQueryValue($uri, 'sig', $sig);

        return parent::__invoke($request->withUri($uri), $options);
    }

    /**
     * Generates a ``sig`` value for a request.
     *
     * @param  string $endpoint
     * @param  array  $params
     * @param  string $secret
     *
     * @return string
     */
    protected function generateSig($endpoint, array $params, $secret)
    {
        $sig = $endpoint;
        ksort($params);
        foreach ($params as $key => $val) {
            $sig .= "|$key=$val";
        }
        return hash_hmac('sha256', $sig, $secret, false);
    }
}
