<?php

namespace Instagram\Entities;

use Instagram\Client;
use Instagram\Http\Response;

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