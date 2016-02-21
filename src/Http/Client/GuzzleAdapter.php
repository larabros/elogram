<?php

namespace Instagram\Http\Client;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Instagram\Http\Response;
use League\OAuth2\Client\Token\AccessToken;

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
     * @inheritDoc
     */
    public function request($method, $uri, array $parameters = [])
    {
        try {
            $response = $this->guzzle->$method($uri, $parameters);
        } catch (ClientException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        return Response::createFromResponse(json_decode($response->getBody()->getContents(), true));
    }

    /**
     * @inheritDoc
     */
    public function paginate(Response $response, $limit = null)
    {
        // If there's nothing to paginate, return response as-is
        if (!$response->hasPages()) {
            return $response;
        }

        // Set `$count`, save the response data and get the next URL
        // @TODO: Remove $count
        $count         = 0;
        $responseStack = [$response->get()];
        $nextUrl       = $response->nextUrl();

        // If we run out of pages OR reach `$limit`, then stop and return response
        while($nextUrl !== null || ($limit !== null && $count === $limit)) {
            $nextResponseJson = $this->guzzle->get($nextUrl)->getBody()->getContents();
//            $nextResponseJson = $this->request('GET', $nextUrl)->getBody()->getContents();
            $nextResponse     = Response::createFromResponse(json_decode($nextResponseJson, true));

            $responseStack[] = $nextResponse->get();
            $nextUrl         = $nextResponse->nextUrl();
            $count++;
        }

        return new Response($response->getRaw()['meta'], array_flatten($responseStack, 1));
    }
}
