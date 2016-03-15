<?php

namespace Larabros\Elogram\Tests\Repositories;

use Larabros\Elogram\Repositories\LikesRepository;
use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Tests\TestCase;

class LikesRepositoryTest extends TestCase
{
    /**
     * @var LikesRepository
     */
    protected $like;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->like = new LikesRepository(new MockAdapter($this->getFixturesPath()));
    }

    /**
     * @covers Larabros\Elogram\Repositories\LikesRepository::__construct()
     * @covers Larabros\Elogram\Repositories\LikesRepository::get()
     */
    public function testGet()
    {
        $response = $this->like->get('420')->get();
        $this->assertCount(3, $response);
    }

    /**
     * @covers Larabros\Elogram\Repositories\LikesRepository::__construct()
     * @covers Larabros\Elogram\Repositories\LikesRepository::like()
     */
    public function testCreate()
    {
        $response = $this->like->like('315')->get();
        $this->assertNull($response);
    }

    /**
     * @covers Larabros\Elogram\Repositories\LikesRepository::__construct()
     * @covers Larabros\Elogram\Repositories\LikesRepository::unlike()
     */
    public function testDelete()
    {
        $response = $this->like->unlike('315')->get();
        $this->assertNull($response);
    }
}
