<?php

namespace Elogram\Tests\Entities;

use Elogram\Entities\User;
use Elogram\Http\Clients\MockAdapter;
use Elogram\Tests\TestCase;

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
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::get()
     */
    public function testGet()
    {
        $response = $this->user->get()->get();
        $this->assertEquals('mikeyk', $response['username']);
    }

    /**
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::getMedia()
     */
    public function testGetMedia()
    {
        $response = $this->user->getMedia()->get();
        $this->assertCount(2, $response);
    }

    /**
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::getLikedMedia()
     */
    public function testGetLikedMedia()
    {
        $response = $this->user->getLikedMedia()->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::search()
     */
    public function testSearch()
    {
        $response = $this->user->search('mikeyk')->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::find()
     */
    public function testFind()
    {
        $response = $this->user->find('mikeyk')->get();
        $this->assertEquals('mikeyk', $response['username']);
    }

    /**
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::find()
     */
    public function testFindReturnsNullWhenNothingFound()
    {
        $response = $this->user->find('quh');
        $this->assertNull($response);
    }

    /**
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::follows()
     */
    public function testFollows()
    {
        $response = $this->user->follows()->get();
        $this->assertCount(50, $response);
    }

    /**
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::followedBy()
     */
    public function testFollowedBy()
    {
        $response = $this->user->followedBy()->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::requestedBy()
     */
    public function testRequestedBy()
    {
        $response = $this->user->requestedBy()->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::getRelationship()
     */
    public function testGetRelationship()
    {
        $response = $this->user->getRelationship(10)->get();
        $this->assertArrayHasKey('outgoing_status', $response);
        $this->assertArrayHasKey('incoming_status', $response);
    }

    /**
     * @covers Elogram\Entities\User::__construct()
     * @covers Elogram\Entities\User::setRelationship()
     */
    public function testSetRelationship()
    {
        $response = $this->user->setRelationship('10', 'follow')->get();
        $this->assertArrayHasKey('outgoing_status', $response);
    }
}
