<?php

namespace Larabros\Elogram\Tests\Entities;

use Larabros\Elogram\Entities\Media;
use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Tests\TestCase;

class MediaTest extends TestCase
{
    /**
     * @var Media
     */
    protected $media;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->media = new Media(new MockAdapter($this->getFixturesPath()));
    }

    /**
     * @covers Larabros\Elogram\Entities\Media::__construct()
     * @covers Larabros\Elogram\Entities\Media::get()
     */
    public function testGet()
    {
        $response = $this->media->get('315')->get();
        $this->assertEquals('mikeyk', $response['user']['username']);
        $this->assertEquals('315', $response['id']);
    }

    /**
     * @covers Larabros\Elogram\Entities\Media::__construct()
     * @covers Larabros\Elogram\Entities\Media::getByShortcode()
     */
    public function testGetByShortcode()
    {
        $response = $this->media->getByShortcode('os1NQjxtvF')->get();
        $this->assertEquals('neymarjr', $response['user']['username']);
        $this->assertEquals('733194846952938437_26669533', $response['id']);
    }

    /**
     * @covers Larabros\Elogram\Entities\Media::__construct()
     * @covers Larabros\Elogram\Entities\Media::search()
     */
    public function testSearch()
    {
        $response = $this->media->search(37.7, -122.22)->get();
        $this->assertCount(8, $response);
    }
}
