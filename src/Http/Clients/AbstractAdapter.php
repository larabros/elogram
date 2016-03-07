<?php

namespace Instagram\Http\Clients;

use Instagram\Http\Response;

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
}
