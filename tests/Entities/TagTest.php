<?php

namespace Elogram\Tests\Entities;

use Elogram\Entities\Tag;
use Elogram\Http\Clients\MockAdapter;
use Elogram\Tests\TestCase;

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
     * @covers Elogram\Entities\Tag::__construct()
     * @covers Elogram\Entities\Tag::get()
     */
    public function testGet()
    {
        $response = $this->tag->get('nofilter')->get();
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('media_count', $response);
    }

    /**
     * @covers Elogram\Entities\Tag::__construct()
     * @covers Elogram\Entities\Tag::getRecentMedia()
     */
    public function testGetRecentMedia()
    {
        $response = $this->tag->getRecentMedia('snowy')->get();
        $this->assertCount(2, $response);
    }

    /**
     * @covers Elogram\Entities\Tag::__construct()
     * @covers Elogram\Entities\Tag::search()
     */
    public function testSearch()
    {
        $response = $this->tag->search('snowy')->get();
        $this->assertCount(3, $response);
    }
}
