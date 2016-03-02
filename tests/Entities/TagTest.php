<?php

namespace Instagram\Tests\Entities;

use Instagram\Entities\Tag;
use Instagram\Http\Client\MockAdapter;
use Instagram\Tests\TestCase;

class TagTest extends TestCase
{
    /**
     * @var Tag
     */
    protected $tag;

    protected function setUp()
    {
        $this->tag = new Tag(new MockAdapter(realpath(__DIR__.'/../fixtures/').'/'));
    }

    /**
     * @covers Instagram\Entities\Tag::__construct()
     * @covers Instagram\Entities\Tag::get()
     */
    public function testGet()
    {
        $response = $this->tag->get('nofilter')->get();
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('media_count', $response);
    }

    /**
     * @covers Instagram\Entities\Tag::__construct()
     * @covers Instagram\Entities\Tag::getRecentMedia()
     */
    public function testGetRecentMedia()
    {
        $response = $this->tag->getRecentMedia('snowy')->get();
        $this->assertCount(2, $response);
    }

    /**
     * @covers Instagram\Entities\Tag::__construct()
     * @covers Instagram\Entities\Tag::search()
     */
    public function testSearch()
    {
        $response = $this->tag->search('snowy')->get();
        $this->assertCount(3, $response);
    }
}
