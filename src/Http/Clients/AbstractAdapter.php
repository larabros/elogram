<?php

namespace Larabros\Elogram\Http\Clients;

use GuzzleHttp\Exception\ClientException;
use Larabros\Elogram\Exceptions\Exception;
use Larabros\Elogram\Http\Response;

/**
 * An abstract HTTP client adapter.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
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

        // If ``$limit`` is not set then call itself indefinitely
        if ($limit === null) {
            return $this->paginate($merged);
        }

        // If ``$limit`` is set, call itself while decrementing it each time
        $limit--;
        return $this->paginate($merged, $limit);
    }

    /**
     * Parses a ``ClientException`` for any specific exceptions thrown by the
     * API in the response body. If the response body is not in JSON format,
     * an ``Exception`` is returned.
     *
     * Check a ``ClientException`` to see if it has an associated
     * ``ResponseInterface`` object.
     *
     * @param ClientException $exception
     * @return Exception
     */
    protected function resolveExceptionClass(ClientException $exception)
    {
        $response  = $exception->getResponse()->getBody();
        $response  = json_decode($response->getContents());

        if ($response === null) {
            return new Exception($exception->getMessage());
        }

        $meta  = isset($response->meta) ? $response->meta : $response;
        $class = '\\Larabros\\Elogram\\Exceptions\\'.$meta->error_type;
        return new $class($meta->error_message);
    }
}
