<?php

namespace Larabros\Elogram\Tests\Entities;

use Larabros\Elogram\Entities\User;
use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    protected $user;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->user = new User(new MockAdapter($this->getFixturesPath()));
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::get()
     */
    public function testGet()
    {
        $response = $this->user->get()->get();
        $this->assertEquals('mikeyk', $response['username']);
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::getMedia()
     */
    public function testGetMedia()
    {
        $response = $this->user->getMedia()->get();
        $this->assertCount(2, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::getLikedMedia()
     */
    public function testGetLikedMedia()
    {
        $response = $this->user->getLikedMedia()->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::search()
     */
    public function testSearch()
    {
        $response = $this->user->search('mikeyk')->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::find()
     */
    public function testFind()
    {
        $response = $this->user->find('mikeyk')->get();
        $this->assertEquals('mikeyk', $response['username']);
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::find()
     */
    public function testFindReturnsNullWhenNothingFound()
    {
        $response = $this->user->find('quh');
        $this->assertNull($response);
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::follows()
     */
    public function testFollows()
    {
        $response = $this->user->follows()->get();
        $this->assertCount(50, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::followedBy()
     */
    public function testFollowedBy()
    {
        $response = $this->user->followedBy()->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::requestedBy()
     */
    public function testRequestedBy()
    {
        $response = $this->user->requestedBy()->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::getRelationship()
     */
    public function testGetRelationship()
    {
        $response = $this->user->getRelationship(10)->get();
        $this->assertArrayHasKey('outgoing_status', $response);
        $this->assertArrayHasKey('incoming_status', $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\User::__construct()
     * @covers Larabros\Elogram\Entities\User::setRelationship()
     */
    public function testSetRelationship()
    {
        $response = $this->user->setRelationship('10', 'follow')->get();
        $this->assertArrayHasKey('outgoing_status', $response);
    }
}
