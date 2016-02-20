<?php

namespace Instagram\Http;

/**
 * Response
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class Response
{
    protected $raw;
    protected $meta;
    protected $data;
    protected $pagination;

    /**
     * Creates a new instance of `Response`.
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
            'meta' => $this->meta,
            'data' => $data,
            'pagination' => $this->pagination
        ];
    }

    /**
     * Creates a new instance of `Response` from a JSON-decoded response body.
     *
     * @param array $response
     *
     * @return static
     */
    public static function createFromResponse(array $response)
    {
        return new static($response['meta'], $response['data'], $response['pagination'] ?: []);
    }

    /**
     * Returns JSON-decoded raw response.
     *
     * @return array
     */
    public function getRaw()
    {
        return $this->raw;
    }

    /**
     * Returns `data` from the response.
     *
     * @return array
     */
    public function get()
    {
        return $this->data;
    }

    /**
     * If the response has a `pagination` field with a `next_url` key, then
     * returns `true`, otherwise `false`.
     *
     * @return bool
     */
    public function hasPages()
    {
        return !empty($this->pagination) && array_key_exists('next_url', $this->pagination);
    }

    /**
     * Returns the next URL, if available, otherwise `null`.
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
