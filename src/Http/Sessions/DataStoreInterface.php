<?php

namespace Larabros\Elogram\Http\Sessions;

/**
 * Defines an interface for getting and setting values from a data store.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
interface DataStoreInterface
{
    /**
     * Get a value from a data store.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * Set a value in the data store.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return  void
     */
    public function set($key, $value);
}
