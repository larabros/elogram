<?php

namespace Larabros\Elogram\Tests\Repositories;

use Larabros\Elogram\Repositories\CommentsRepository;
use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Tests\TestCase;

class CommentsRepositoryTest extends TestCase
{
    /**
     * @var CommentsRepository
     */
    protected $comment;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->comment = new CommentsRepository(new MockAdapter($this->getFixturesPath()));
    }

    /**
     * @covers Larabros\Elogram\Repositories\CommentsRepository::__construct()
     * @covers Larabros\Elogram\Repositories\CommentsRepository::get()
     */
    public function testGet()
    {
        $response = $this->comment->get('420')->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Larabros\Elogram\Repositories\CommentsRepository::__construct()
     * @covers Larabros\Elogram\Repositories\CommentsRepository::create()
     */
    public function testCreate()
    {
        $response = $this->comment->create('315', 'A comment')->get();
        $this->assertNull($response);
    }

    /**
     * @covers Larabros\Elogram\Repositories\CommentsRepository::__construct()
     * @covers Larabros\Elogram\Repositories\CommentsRepository::delete()
     */
    public function testDelete()
    {
        $response = $this->comment->delete('315', '1')->get();
        $this->assertNull($response);
    }
}
