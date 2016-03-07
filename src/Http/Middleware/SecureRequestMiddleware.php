<?php

namespace Instagram\Http\Middleware;

use GuzzleHttp\Psr7\Uri;
use Instagram\Instagram;
use Psr\Http\Message\RequestInterface;

/**
 * A middleware class for making secure requests to Instagram's API.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
final class SecureRequestMiddleware extends AbstractMiddleware
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(RequestInterface $request, array $options)
    {
        $next = $this->nextHandler;

        if (!$this->config->get('secure_requests')) {
            return $next($request, $options);
        }

        $uri     = $request->getUri();
        $params  = $this->getParams($uri->getQuery());
        $path    = $this->getPath($uri->getPath());
        $secret  = $this->config->get('client_secret');
        $uri     = Uri::withQueryValue($uri, 'sig', $this->generateSig($path, $params, $secret));

        return parent::__invoke($request->withUri($uri), $options);
    }

    private function getPath($path)
    {
        $pattern = '/^\/v'.Instagram::API_VERSION.'\//';
        return preg_replace($pattern, '/', $path);
    }

    private function getParams($query)
    {
        $params = [];
        parse_str($query, $params);
        return $params;
    }

    protected function generateSig($endpoint, $params, $secret)
    {
        $sig = $endpoint;
        ksort($params);
        foreach ($params as $key => $val) {
            $sig .= "|$key=$val";
        }
        return hash_hmac('sha256', $sig, $secret, false);
    }
}
