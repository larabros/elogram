<?php

namespace Larabros\Elogram\Tests\Repositories;

use Larabros\Elogram\Repositories\TagsRepository;
use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Tests\TestCase;

class TagsRepositoryTest extends TestCase
{
    /**
     * @var TagsRepository
     */
    protected $tag;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->tag = new TagsRepository(new MockAdapter($this->getFixturesPath()));
    }

    /**
     * @covers Larabros\Elogram\Repositories\TagsRepository::__construct()
     * @covers Larabros\Elogram\Repositories\TagsRepository::get()
     */
    public function testGet()
    {
        $response = $this->tag->get('nofilter')->get();
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('media_count', $response);
    }

    /**
     * @covers Larabros\Elogram\Repositories\TagsRepository::__construct()
     * @covers Larabros\Elogram\Repositories\TagsRepository::getRecentMedia()
     */
    public function testGetRecentMedia()
    {
        $response = $this->tag->getRecentMedia('snowy')->get();
        $this->assertCount(2, $response);
    }

    /**
     * @covers Larabros\Elogram\Repositories\TagsRepository::__construct()
     * @covers Larabros\Elogram\Repositories\TagsRepository::search()
     */
    public function testSearch()
    {
        $response = $this->tag->search('snowy')->get();
        $this->assertCount(3, $response);
    }
}
