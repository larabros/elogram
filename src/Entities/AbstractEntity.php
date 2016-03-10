<?php

namespace Larabros\Elogram\Entities;

use Larabros\Elogram\Http\Clients\AdapterInterface;

/**
 * An abstract entity class. Any new endpoints should extend this class.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
abstract class AbstractEntity
{
    /**
     * @var AdapterInterface
     */
    protected $client;

    /**
     * Creates a new instance of :php:class:`AbstractEntity`.
     *
     * @param AdapterInterface $client
     */
    public function __construct(AdapterInterface $client)
    {
        $this->client = $client;
    }
}
