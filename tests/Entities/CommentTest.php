<?php

namespace Instagram\Tests\Entities;

use Instagram\Entities\Comment;
use Instagram\Http\Clients\MockAdapter;
use Instagram\Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * @var Comment
     */
    protected $comment;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->comment = new Comment(new MockAdapter($this->getFixturesPath()));
    }

    /**
     * @covers Instagram\Entities\Comment::__construct()
     * @covers Instagram\Entities\Comment::get()
     */
    public function testGet()
    {
        $response = $this->comment->get('420')->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Instagram\Entities\Comment::__construct()
     * @covers Instagram\Entities\Comment::create()
     */
    public function testCreate()
    {
        $response = $this->comment->create('315', 'A comment')->get();
        $this->assertNull($response);
    }

    /**
     * @covers Instagram\Entities\Comment::__construct()
     * @covers Instagram\Entities\Comment::delete()
     */
    public function testDelete()
    {
        $response = $this->comment->delete('315', '1')->get();
        $this->assertNull($response);
    }
}
