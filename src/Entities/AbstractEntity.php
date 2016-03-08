<?php

namespace Larabros\Elogram\Entities;

use Larabros\Elogram\Http\Clients\AdapterInterface;

/**
 * AbstractEntity
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/elogram-sdk
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
