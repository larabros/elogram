<?php

namespace Larabros\Elogram\Http\Middleware;

use Closure;
use Noodlehaus\ConfigInterface;

/**
 * A trait for creating callables for registering middleware on a handler stack.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
trait CreateMiddlewareTrait
{
    /**
     * Factory method used to register this middleware on a handler stack.
     *
     * @param ConfigInterface $config
     *
     * @return Closure
     */
    public static function create(ConfigInterface $config)
    {
        return function (callable $handler) use ($config) {
            return new static($handler, $config);
        };
    }
}
