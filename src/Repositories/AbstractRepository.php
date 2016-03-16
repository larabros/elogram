<?php

namespace Larabros\Elogram\Repositories;

use Larabros\Elogram\Http\Clients\AdapterInterface;

/**
 * An abstract repository class. Any new endpoints should extend this class.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
abstract class AbstractRepository
{
    /**
     * @var AdapterInterface
     */
    protected $client;

    /**
     * Creates a new instance of :php:class:`AbstractRepository`.
     *
     * @param AdapterInterface $client
     */
    public function __construct(AdapterInterface $client)
    {
        $this->client = $client;
    }
}
