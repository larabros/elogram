<?php

namespace Larabros\Elogram\Tests\Entities;

use Larabros\Elogram\Entities\Tag;
use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Tests\TestCase;

class TagTest extends TestCase
{
    /**
     * @var Tag
     */
    protected $tag;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->tag = new Tag(new MockAdapter($this->getFixturesPath()));
    }

    /**
     * @covers Larabros\Elogram\Entities\Tag::__construct()
     * @covers Larabros\Elogram\Entities\Tag::get()
     */
    public function testGet()
    {
        $response = $this->tag->get('nofilter')->get();
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('media_count', $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\Tag::__construct()
     * @covers Larabros\Elogram\Entities\Tag::getRecentMedia()
     */
    public function testGetRecentMedia()
    {
        $response = $this->tag->getRecentMedia('snowy')->get();
        $this->assertCount(2, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\Tag::__construct()
     * @covers Larabros\Elogram\Entities\Tag::search()
     */
    public function testSearch()
    {
        $response = $this->tag->search('snowy')->get();
        $this->assertCount(3, $response);
    }
}
