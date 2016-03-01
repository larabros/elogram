<?php

namespace Instagram\Tests\Entities;

use Instagram\Entities\Media;
use Instagram\Http\Client\MockAdapter;
use Instagram\Tests\TestCase;

class MediaTest extends TestCase
{
    /**
     * @var Media
     */
    protected $media;

    protected function setUp()
    {
        $this->media = new Media(new MockAdapter(realpath(__DIR__.'/../fixtures/').'/'));
    }

    /**
     * @covers Instagram\Entities\Media::__construct()
     * @covers Instagram\Entities\Media::get()
     */
    public function testGet()
    {
        $response = $this->media->get('315')->get();
        $this->assertEquals('mikeyk', $response['user']['username']);
        $this->assertEquals('315', $response['id']);
    }

    /**
     * @covers Instagram\Entities\Media::__construct()
     * @covers Instagram\Entities\Media::getByShortcode()
     */
    public function testGetByShortcode()
    {
        $response = $this->media->getByShortcode('os1NQjxtvF')->get();
        $this->assertEquals('neymarjr', $response['user']['username']);
        $this->assertEquals('733194846952938437_26669533', $response['id']);
    }

    /**
     * @covers Instagram\Entities\Media::__construct()
     * @covers Instagram\Entities\Media::search()
     */
    public function testSearch()
    {
        $response = $this->media->search(37.7, -122.22)->get();
        $this->assertCount(8, $response);
    }
}
