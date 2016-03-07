<?php

namespace Instagram\Http\Middleware;

use Closure;
use Noodlehaus\ConfigInterface;

/**
 * A trait for creating and registering middleware on a handler stack.
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
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
