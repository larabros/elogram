<?php

namespace Instagram\Http\Clients;

use GuzzleHttp\Exception\ClientException;
use Instagram\Exceptions\Exception;
use Instagram\Http\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * An abstract HTTP client adapter.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
abstract class AbstractAdapter implements AdapterInterface
{
    /**
     * {@inheritDoc}
     */
    abstract public function request($method, $uri, array $parameters = []);

    /**
     * {@inheritDoc}
     */
    public function paginate(Response $response, $limit = null)
    {
        // If there's nothing to paginate, return response as-is
        if (!$response->hasPages() || $limit === 0) {
            return $response;
        }

        $next   = $this->request('GET', $response->nextUrl());
        $merged = $response->merge($next);

        // If `$limit` is not set then call itself indefinitely
        if ($limit === null) {
            return $this->paginate($merged);
        }

        // If `$limit` is set, call itself while decrementing it each time
        $limit--;
        return $this->paginate($merged, $limit);
    }

    protected function resolveExceptionClass(ClientException $exception)
    {
        $response  = $exception->getResponse()->getBody();
        $response  = json_decode($response->getContents());

        if ($response === null) {
            return new Exception($exception->getMessage());
        }

        $meta      = isset($response->meta) ? $response->meta : $response;
        $class     = '\\Instagram\\Exceptions\\'.$meta->error_type;
        return new $class($meta->error_message);
    }
}
