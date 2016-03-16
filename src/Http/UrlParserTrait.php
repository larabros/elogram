<?php

namespace Larabros\Elogram\Http;

use Larabros\Elogram\Client;
use Psr\Http\Message\UriInterface;

/**
 * Adds utility classes for parsing parts of a URL.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
trait UrlParserTrait
{
    /**
     * Gets the path from a ``UriInterface`` instance after removing the version
     * prefix.
     *
     * @param UriInterface $uri
     *
     * @return string
     */
    public function getPath(UriInterface $uri)
    {
        $path  = trim($uri->getPath(), '/');
        $parts = explode('/', $path);

        if ($parts[0] === 'v'.Client::API_VERSION) {
            unset($parts[0]);
        }

        return '/'.implode('/', $parts);
    }

    /**
     * Gets the query parameters as an array from a ``UriInterface`` instance.
     *
     * @param UriInterface $uri
     * @param array $exclude
     * @param array $params
     *
     * @return array
     */
    public function getQueryParams(UriInterface $uri, $exclude = ['sig'], $params = [])
    {
        parse_str($uri->getQuery(), $params);
        foreach ($exclude as $excludedParam) {
            if (array_key_exists($excludedParam, $params)) {
                unset($params[$excludedParam]);
            }
        }
        return $params;
    }
}
