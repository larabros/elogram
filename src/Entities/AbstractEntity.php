<?php

namespace Instagram\Entities;

use Instagram\Http\Clients\AdapterInterface;

/**
 * AbstractEntity
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
abstract class AbstractEntity
{
    /**
     * @var AdapterInterface
     */
    protected $client;

    /**
     * Creates a new instance of `User`.
     *
     * @param AdapterInterface $client
     */
    public function __construct(AdapterInterface $client)
    {
        $this->client = $client;
    }
}
