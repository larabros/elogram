<?php

namespace Larabros\Elogram\Http\Clients;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Larabros\Elogram\Http\Response;

interface AdapterInterface
{
    /**
     * Sends a HTTP request using `$method` to the given `$uri`, with
     * `$parameters` if provided.
     *
     * Use this method as a convenient way of making requests with built-in
     * exception-handling.
     *
     * @param  string $method
     * @param  string $uri
     * @param  array $parameters
     *
     * @return Response
     *
     * @throws ClientException
     * @throws Exception If an invalid HTTP method is specified
     */
    public function request($method, $uri, array $parameters = []);

    /**
     * Paginates a `Response`. The pagination limit is set by `$limit` -
     * setting it to `null` will paginate as far as possible.
     *
     * @param Response  $response
     * @param int|null  $limit
     *
     * @return Response
     */
    public function paginate(Response $response, $limit = null);
}
