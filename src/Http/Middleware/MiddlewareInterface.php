<?php

namespace Larabros\Elogram\Http\Middleware;

use Psr\Http\Message\RequestInterface;

/**
 * An interface for PSR-7 compatible middleware.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
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
