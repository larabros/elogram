<?php

namespace Instagram;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Instagram\Http\Response;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

/**
 * Instagram client class.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
final class Client
{
    /**
     * The OAuth token, obtained after logging in or provided through the
     * constructor.
     *
     * @var AccessToken|null
     */
    protected $token;

    /**
     * The Guzzle client instance.
     *
     * @var ClientInterface
     */
    protected $guzzle;

    /**
     * @var ResponseInterface
     */
    protected $lastResponse;

    /**
     * @inheritDoc
     */
    public function __construct(AccessToken $token, ClientInterface $guzzle = null)
    {
        $this->token  = $token;
        $this->guzzle = $guzzle;
    }

    /**
     * Sends a HTTP request using `$method` to the given `$uri`, with
     * `$parameters` if provided.
     *
     * Use this method in subclasses as a convenient way of making requests
     * with built-in exception-handling.
     *
     * @param  string $method
     * @param  string $uri
     * @param  array $parameters
     * @return mixed
     *
     * @throws ClientException
     * @throws Exception If an invalid HTTP method is specified
     */
    public function request($method, $uri, array $parameters = [])
    {
        try {
            $response = $this->guzzle->$method(
                $uri,
                $this->createRequestParameters($parameters)
            );
        } catch (ClientException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        return $this->lastResponse = Response::createFromResponse(json_decode($response->getBody()->getContents(), true));
    }

    /**
     * Returns the last `ResponseInterface`.
     *
     * @return ResponseInterface
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @inheritDoc
     * @TODO Make this a middleware instead.
     */
    protected function createRequestParameters($parameters = [])
    {
        $parameters = array_merge_recursive([
            'query' => [
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'access_token'  => $this->token->getToken(),
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ], $parameters);

        return array_map('array_filter', $parameters);
    }
}
