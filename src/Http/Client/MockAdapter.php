<?php

namespace Instagram\Http\Client;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Instagram\Http\Response;

/**
 * Instagram mock client class.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
final class MockAdapter implements AdapterInterface
{
    /**
     * @var string
     */
    protected $fixturesPath;

    /**
     * Creates a new instance of `MockAdapter`.
     *
     */
    public function __construct()
    {
        $this->fixturesPath = realpath(__DIR__.'/../../../tests/fixtures/').'/';
    }

    /**
     * @inheritDoc
     */
    public function request($method, $uri, array $parameters = [])
    {
        $file = file_get_contents($this->mapRequestToFile($method, $uri));
        return Response::createFromJson(json_decode($file, true));

    }

    protected function mapRequestToFile($method, $uri)
    {
        $filename  = strtolower($method).'_';
        $uri       = str_replace('//', '_', preg_replace('/(self|\d*)/', '', $uri));
        $filename .= rtrim(str_replace('/', '_', $uri), '_').'.json';
        return $this->fixturesPath.$filename;
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

        // Add the response data to the stack and get the next URL
        $responseStack = [$response->get()];
        $nextUrl       = $response->nextUrl();

        // If we run out of pages OR reach `$limit`, then stop and return response
        while($nextUrl !== null || ($limit !== null && count($responseStack) <= $limit)) {
            $nextResponse    = $this->request('GET', $nextUrl);
            $responseStack[] = $nextResponse->get();
            $nextUrl         = $nextResponse->nextUrl();
        }

        return new Response($response->getRaw()['meta'], array_flatten($responseStack, 1));
    }
}
