<?php

namespace Instagram\Http\Clients;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Instagram\Http\Response;

/**
 * Instagram client class.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
final class GuzzleAdapter implements AdapterInterface
{
    /**
     * The Guzzle client instance.
     *
     * @var ClientInterface
     */
    protected $guzzle;

    /**
     * Creates a new instance of `GuzzleAdapter`.
     *
     * @param ClientInterface $guzzle
     */
    public function __construct(ClientInterface $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * {@inheritDoc}
     */
    public function request($method, $uri, array $parameters = [])
    {
        try {
            $response = $this->guzzle->request($method, $uri, $parameters);

        } catch (ClientException $e) {

            if (!$e->hasResponse()) {
                throw $e;
            }

            $response  = json_decode($e->getResponse()->getBody()->getContents());
            $exception = "\\Instagram\\Exceptions\\$response->error_type";
            throw new $exception($response->error_message);

        } catch (Exception $e) {
            throw $e;
        }

        return Response::createFromJson(json_decode($response->getBody()->getContents(), true));
    }

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
