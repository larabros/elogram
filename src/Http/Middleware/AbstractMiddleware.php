<?php

namespace Larabros\Elogram\Http\Middleware;

use Noodlehaus\ConfigInterface;
use Psr\Http\Message\RequestInterface;

/**
 * An abstract middleware class.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
abstract class AbstractMiddleware implements MiddlewareInterface
{
    /**
     * The next handler in the stack.
     *
     * @var callable
     */
    protected $nextHandler;

    /**
     * The application configuration.
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Creates an instance of :php:class:`AbstractMiddleware`.
     *
     * @param callable        $nextHandler
     * @param ConfigInterface $config
     *
     * @see AbstractMiddleware::create()
     */
    protected function __construct(callable $nextHandler, ConfigInterface $config)
    {
        $this->nextHandler = $nextHandler;
        $this->config      = $config;
    }

    /**
     * {@inheritDoc}
     */
    public function __invoke(RequestInterface $request, array $options)
    {
        $next = $this->nextHandler;
        return $next($request, $options);
    }
}
