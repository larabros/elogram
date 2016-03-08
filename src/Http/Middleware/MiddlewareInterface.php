<?php

namespace Instagram\Http\Middleware;

use Psr\Http\Message\RequestInterface;

/**
 * An interface for PSR-7 compatible middleware.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
interface MiddlewareInterface
{
    /**
     * Execute the middleware.
     *
     * @param RequestInterface $request
     * @param array $options
     *
     * @return mixed
     */
    public function __invoke(RequestInterface $request, array $options);
}
