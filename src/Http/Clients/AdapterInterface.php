<?php

namespace Larabros\Elogram\Http\Clients;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Larabros\Elogram\Http\Response;

/**
 * An interface for HTTP clients.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
interface AdapterInterface
{
    /**
     * Sends a HTTP request. Use this method as a convenient way of making
     * requests with built-in exception-handling.
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
     * Paginates a :php:class:`Response`.
     *
     * @param Response  $response
     * @param int|null  $limit     If not set, the client will paginate as far as possible
     *
     * @return Response
     */
    public function paginate(Response $response, $limit = null);
}
