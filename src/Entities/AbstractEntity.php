<?php

namespace Instagram\Entities;

use Instagram\Client;

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
     * @var ClientInterface
     */
    protected $client;

    /**
     * Creates a new instance of `User`.
     *
     * @param Client|ClientInterface $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


}