<?php

namespace Larabros\Elogram\Http;

use Illuminate\Support\Collection;
use Larabros\Elogram\Exceptions\IncompatibleResponseException;

/**
 * Represents a response returned from the API.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
class Response
{
    /**
     * @var array
     */
    protected $raw;

    /**
     * @var array
     */
    protected $meta;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $pagination;

    /**
     * Creates a new instance of :php:class:`Response`.
     *
     * @param array $meta
     * @param array $data
     * @param array $pagination
     */
    public function __construct($meta = [], $data = [], $pagination = [])
    {
        $this->meta       = $meta;
        $this->data       = $data;
        $this->pagination = $pagination;
        $this->raw        = [
            'meta' => $meta,
            'data' => $data,
        ];

        if (!empty($pagination)) {
            $this->raw['pagination'] = $pagination;
        }
    }

    /**
     * Creates a new instance of :php:class:`Response` from a JSON-decoded
     * response body.
     *
     * @param array $response
     *
     * @return static
     */
    public static function createFromJson(array $response)
    {
        $meta       = array_key_exists('meta', $response)       ? $response['meta']       : ['code' => 200];
        $data       = array_key_exists('data', $response)       ? $response['data']       : $response;
        $pagination = array_key_exists('pagination', $response) ? $response['pagination'] : [];

        return new static($meta, $data, $pagination);
    }

    /**
     * Gets the JSON-decoded raw response.
     *
     * @param string|null $key
     *
     * @return array
     */
    public function getRaw($key = null)
    {
        return $key === null
            ? $this->raw
            : $this->raw[$key];
    }

    /**
     * Gets the response body. If the response contains multiple records,
     * a ``Collection`` is returned.
     *
     * @return array|Collection
     */
    public function get()
    {
        return $this->isCollection($this->data)
            ? new Collection($this->data)
            : $this->data;
    }

    /**
     * Merges the contents of this response with ``$response`` and returns a new
     * :php:class:`Response` instance.
     *
     * @param Response $response
     *
     * @return Response
     *
     * @throws IncompatibleResponseException
     */
    public function merge(Response $response)
    {
        $meta       = $response->getRaw('meta');
        $data       = $response->get();
        $pagination = $response->hasPages()
            ? $response->getRaw('pagination')
            : [];

        $old = $this->get();

        if ($this->isCollection($old) && $this->isCollection($data)) {
            $old = !($old instanceof Collection) ?: $old->toArray();
            $new = !($data instanceof Collection) ?: $data->toArray();

            return new Response($meta, array_merge($old, $new), $pagination);
        }

        if ($this->isRecord($old) && $this->isRecord($data)) {
            return new Response($meta, [$old, $data], $pagination);
        }

        throw new IncompatibleResponseException('The response contents cannot be merged');
    }

    /**
     * Tests the current response data to see if one or more records were
     * returned.
     *
     * @param array|Collection $data
     *
     * @return bool
     */
    protected function isCollection($data)
    {
        $isCollection = false;

        if ($data === null) {
            return $isCollection;
        }

        if (!$this->isRecord($data)) {
            $isCollection = true;
        }

        return $isCollection;
    }

    /**
     * Tests the current response data to see if a single record was returned.
     *
     * @param array|Collection $data
     *
     * @return bool
     */
    protected function isRecord($data)
    {
        if ($data instanceof Collection) {
            return false;
        }

        $keys = array_keys($data);
        return (in_array('id', $keys, true) || in_array('name', $keys, true));
    }

    /**
     * If the response has a ``pagination`` field with a ``next_url`` key, then
     * returns ``true``, otherwise ``false``.
     *
     * @return bool
     */
    public function hasPages()
    {
        return !empty($this->pagination) && array_key_exists('next_url', $this->pagination);
    }

    /**
     * Returns the next URL, if available, otherwise ``null``.
     *
     * @return string|null
     */
    public function nextUrl()
    {
        return $this->hasPages()
            ? $this->pagination['next_url']
            : null;
    }

    /**
     * Returns the JSON-encoded raw response.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->getRaw());
    }
}
