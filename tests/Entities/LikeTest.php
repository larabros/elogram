<?php

namespace Instagram\Tests\Entities;

use Instagram\Entities\Like;
use Instagram\Http\Client\MockAdapter;
use Instagram\Tests\TestCase;

class LikeTest extends TestCase
{
    /**
     * @var Like
     */
    protected $like;

    protected function setUp()
    {
        $this->like = new Like(new MockAdapter(realpath(__DIR__.'/../fixtures/').'/'));
    }

    /**
     * @covers Instagram\Entities\Like::__construct()
     * @covers Instagram\Entities\Like::get()
     */
    public function testGet()
    {
        $response = $this->like->get('420')->get();
        $this->assertCount(3, $response);
    }

    /**
     * @covers Instagram\Entities\Like::__construct()
     * @covers Instagram\Entities\Like::like()
     */
    public function testCreate()
    {
        $response = $this->like->like('315')->get();
        $this->assertNull($response);
    }

    /**
     * @covers Instagram\Entities\Like::__construct()
     * @covers Instagram\Entities\Like::unlike()
     */
    public function testDelete()
    {
        $response = $this->like->unlike('315')->get();
        $this->assertNull($response);
    }
}
