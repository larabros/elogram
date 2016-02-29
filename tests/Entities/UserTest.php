<?php

namespace Instagram\Tests\Entities;

use Instagram\Entities\User;
use Instagram\Http\Client\MockAdapter;
use Instagram\Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    protected $user;

    protected function setUp()
    {
        $this->user = new User(new MockAdapter());
    }

    /**
     * @covers Instagram\Entities\User::__construct()
     * @covers Instagram\Entities\User::get()
     */
    public function testGet()
    {
        $response = $this->user->get()->get();
        $this->assertEquals('mikeyk', $response['username']);
    }

    /**
     * @covers Instagram\Entities\User::__construct()
     * @covers Instagram\Entities\User::getMedia()
     */
    public function testGetMedia()
    {
        $response = $this->user->getMedia()->get();
        $this->assertCount(2, $response);
    }

    /**
     * @covers Instagram\Entities\User::__construct()
     * @covers Instagram\Entities\User::getLikedMedia()
     */
    public function testGetLikedMedia()
    {
        $response = $this->user->getLikedMedia()->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Instagram\Entities\User::__construct()
     * @covers Instagram\Entities\User::search()
     */
    public function testSearch()
    {
        $response = $this->user->search('mikeyk')->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Instagram\Entities\User::__construct()
     * @covers Instagram\Entities\User::find()
     */
    public function testFind()
    {
        $response = $this->user->find('mikeyk')->get();
        $this->assertEquals('mikeyk', $response['username']);
    }
}
