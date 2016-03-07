<?php

namespace Instagram\Http\Middleware;

use GuzzleHttp\Psr7\Uri;
use Instagram\Instagram;
use Noodlehaus\ConfigInterface;
use Psr\Http\Message\RequestInterface;

/**
 * A middleware class for making secure requests to Instagram's API.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
final class SecureRequestMiddleware implements MiddlewareInterface
{
    /**
     * The next handler in the stack.
     *
     * @var callable
     */
    protected $nextHandler;

    /**
     * The application configuration.
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Creates an instance of `AuthMiddleware`.
     *
     * @param callable        $nextHandler
     * @param ConfigInterface $config
     *
     * @see SecureRequestMiddleware::create()
     */
    private function __construct(callable $nextHandler, ConfigInterface $config)
    {
        $this->nextHandler = $nextHandler;
        $this->config      = $config;
    }

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

        $next    = $this->nextHandler;
        return $next($request->withUri($uri), $options);
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

    /**
     * Factory method used to register this class on a handler stack.
     *
     * @param ConfigInterface $config
     * @return \Closure
     */
    public static function create(ConfigInterface $config)
    {
        return function (callable $handler) use ($config) {
            return new static($handler, $config);
        };
    }
}
