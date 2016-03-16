<?php

namespace Larabros\Elogram\Tests\Repositories;

use Larabros\Elogram\Repositories\MediaRepository;
use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Tests\TestCase;

class MediaRepositoryTest extends TestCase
{
    /**
     * @var MediaRepository
     */
    protected $media;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->media = new MediaRepository(new MockAdapter($this->getFixturesPath()));
    }

    /**
     * @covers Larabros\Elogram\Repositories\MediaRepository::__construct()
     * @covers Larabros\Elogram\Repositories\MediaRepository::get()
     */
    public function testGet()
    {
        $response = $this->media->get('315')->get();
        $this->assertEquals('mikeyk', $response['user']['username']);
        $this->assertEquals('315', $response['id']);
    }

    /**
     * @covers Larabros\Elogram\Repositories\MediaRepository::__construct()
     * @covers Larabros\Elogram\Repositories\MediaRepository::getByShortcode()
     */
    public function testGetByShortcode()
    {
        $response = $this->media->getByShortcode('os1NQjxtvF')->get();
        $this->assertEquals('neymarjr', $response['user']['username']);
        $this->assertEquals('733194846952938437_26669533', $response['id']);
    }

    /**
     * @covers Larabros\Elogram\Repositories\MediaRepository::__construct()
     * @covers Larabros\Elogram\Repositories\MediaRepository::search()
     */
    public function testSearch()
    {
        $response = $this->media->search(37.7, -122.22)->get();
        $this->assertCount(8, $response);
    }
}
