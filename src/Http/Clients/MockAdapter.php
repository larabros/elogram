<?php

namespace Instagram\Http\Clients;

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
     * @param string $fixturesPath
     */
    public function __construct($fixturesPath)
    {
        $this->fixturesPath = rtrim($fixturesPath, '/').'/';
    }

    /**
     * {@inheritDoc}
     */
    public function request($method, $uri, array $parameters = [])
    {
        $file = file_get_contents($this->mapRequestToFile($method, $uri, $parameters));
        return Response::createFromJson(json_decode($file, true));
    }

    /**
     * Parse the correct filename from the request.
     *
     * @param string $method
     * @param string $uri
     * @param array  $parameters
     *
     * @return string
     */
    protected function mapRequestToFile($method, $uri, $parameters)
    {
        $filename  = strtolower($method).'_';
        $filename .= $this->cleanPath($uri);
        $suffix    = $this->mapRequestParameters($parameters);
        return $this->fixturesPath.$filename.$suffix.'.json';
    }

    protected function cleanPath($uri)
    {
        $urlPath   = parse_url($uri, PHP_URL_PATH);
        $uri       = str_replace('v1/', '', $urlPath);
        $path      = preg_replace('/(\/\w{10}$|self|\d*)/', '', $uri);
        return trim(preg_replace('/\/{1,2}|\-/', '_', $path), '_');
    }

    /**
     * Parses any filename properties from the request parameters.
     *
     * @param $parameters
     *
     * @return string
     */
    protected function mapRequestParameters($parameters)
    {
        if (empty($parameters) || !array_key_exists('query', $parameters)) {
            return '';
        }

        $exclude = [
            'q',
            'count',
            'min_id',
            'max_id',
            'min_tag_id',
            'max_tag_id',
            'lat',
            'lng',
            'distance',
            'text',
            'max_like_id',
            'action',
            'cursor',
            'access_token',
        ];

        $modifiers = array_except($parameters['query'], $exclude);
        $return    = implode('_', array_keys($modifiers));
        return rtrim("_".$return, '_');
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
