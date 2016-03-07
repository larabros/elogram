<?php

namespace Instagram\Tests\Entities;

use Instagram\Entities\LikeRepository;
use Instagram\Http\Clients\MockAdapter;
use Instagram\Tests\TestCase;

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
     * @covers Instagram\Entities\LikeRepository::__construct()
     * @covers Instagram\Entities\LikeRepository::get()
     */
    public function testGet()
    {
        $response = $this->like->get('420')->get();
        $this->assertCount(3, $response);
    }

    /**
     * @covers Instagram\Entities\LikeRepository::__construct()
     * @covers Instagram\Entities\LikeRepository::like()
     */
    public function testCreate()
    {
        $response = $this->like->like('315')->get();
        $this->assertNull($response);
    }

    /**
     * @covers Instagram\Entities\LikeRepository::__construct()
     * @covers Instagram\Entities\LikeRepository::unlike()
     */
    public function testDelete()
    {
        $response = $this->like->unlike('315')->get();
        $this->assertNull($response);
    }
}
