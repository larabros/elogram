<?php

namespace Larabros\Elogram\Http\Sessions;

use Larabros\Elogram\Exceptions\Exception;

/**
 * An implementation of `DataStoreInterface` that uses native sessions.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
class NativeSessionStore implements DataStoreInterface
{
    /**
     * @var string Prefix to use for session variables.
     */
    protected $sessionPrefix = 'IG_';

    /**
     * Creates an instance of :php:class:`NativeSessionStore`.
     */
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            throw new Exception('Sessions are not active.');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function get($key)
    {
        if (isset($_SESSION[$this->sessionPrefix . $key])) {
            return $_SESSION[$this->sessionPrefix . $key];
        }
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function set($key, $value)
    {
        $_SESSION[$this->sessionPrefix . $key] = $value;
    }
}
