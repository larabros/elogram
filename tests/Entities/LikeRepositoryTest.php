<?php

namespace Larabros\Elogram\Tests\Entities;

use Larabros\Elogram\Entities\LikeRepository;
use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Tests\TestCase;

class LikeRepositoryTest extends TestCase
{
    /**
     * @var LikeRepository
     */
    protected $like;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->like = new LikeRepository(new MockAdapter($this->getFixturesPath()));
    }

    /**
     * @covers Larabros\Elogram\Entities\LikeRepository::__construct()
     * @covers Larabros\Elogram\Entities\LikeRepository::get()
     */
    public function testGet()
    {
        $response = $this->like->get('420')->get();
        $this->assertCount(3, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\LikeRepository::__construct()
     * @covers Larabros\Elogram\Entities\LikeRepository::like()
     */
    public function testCreate()
    {
        $response = $this->like->like('315')->get();
        $this->assertNull($response);
    }

    /**
     * @covers Larabros\Elogram\Entities\LikeRepository::__construct()
     * @covers Larabros\Elogram\Entities\LikeRepository::unlike()
     */
    public function testDelete()
    {
        $response = $this->like->unlike('315')->get();
        $this->assertNull($response);
    }
}
