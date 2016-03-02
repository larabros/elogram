<?php

namespace Instagram\Http\Client;

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
        $this->fixturesPath = $fixturesPath;
    }

    /**
     * @inheritDoc
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
        $path      = preg_replace('/(\/\w{10}$|self|\d*)/', '', $uri);
        $filename .= rtrim(preg_replace('/\/{1,2}|\-/', '_', $path), '_');
        $suffix    = $this->mapRequestParameters($parameters);
        return $this->fixturesPath.$filename.$suffix.'.json';
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
        ];

        $modifiers = array_except($parameters['query'], $exclude);
        $return    = implode('_', array_keys($modifiers));
        return rtrim("_".$return, '_');
    }

    /**
     * @inheritDoc
     */
    public function paginate(Response $response, $limit = null)
    {
        return;
    }
}
