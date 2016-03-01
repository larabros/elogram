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

    /**
     * Convenience method to quickly parse the correct file to load for a given
     * `$method` and `$uri`.
     *
     * @param string $method
     * @param string $uri
     * @return string
     */
    protected function mapRequestToFile($method, $uri)
    {
        $filename  = strtolower($method).'_';
        $uri       = str_replace('//', '_', preg_replace('/(\w{10}$|self|\d*)/', '', $uri));
        $filename .= rtrim(str_replace('/', '_', $uri), '_').'.json';
        return $this->fixturesPath.$filename;
    }

    /**
     * @inheritDoc
     */
    public function paginate(Response $response, $limit = null)
    {
        return;
    }
}
