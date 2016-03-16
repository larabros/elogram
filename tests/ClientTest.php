<?php

namespace Larabros\Elogram\Tests;

use Larabros\Elogram\Config;
use Larabros\Elogram\Repositories\CommentsRepository;
use Larabros\Elogram\Repositories\LikesRepository;
use Larabros\Elogram\Repositories\LocationsRepository;
use Larabros\Elogram\Repositories\MediaRepository;
use Larabros\Elogram\Repositories\TagsRepository;
use Larabros\Elogram\Repositories\UsersRepository;
use Larabros\Elogram\Helpers\RedirectLoginHelper;
use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Http\Response;
use Larabros\Elogram\Client;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $options = [
//            'session_store' => NativeSessionStore::class,
            'http_adapter'  => MockAdapter::class,
        ];
        $this->client = new Client('foo', 'bar', '{"access_token": "baz"}', '/', $options);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::users()
     */
    public function testUsers()
    {
        $users = $this->client->users();
        $this->assertInstanceOf(UsersRepository::class, $users);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::media()
     */
    public function testMedia()
    {
        $media = $this->client->media();
        $this->assertInstanceOf(MediaRepository::class, $media);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::comments()
     */
    public function testComments()
    {
        $comments = $this->client->comments();
        $this->assertInstanceOf(CommentsRepository::class, $comments);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::likes()
     */
    public function testLikes()
    {
        $likes = $this->client->likes();
        $this->assertInstanceOf(LikesRepository::class, $likes);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::tags()
     */
    public function testTags()
    {
        $tags = $this->client->tags();
        $this->assertInstanceOf(TagsRepository::class, $tags);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::locations()
     */
    public function testLocations()
    {
        $locations = $this->client->locations();
        $this->assertInstanceOf(LocationsRepository::class, $locations);
    }
}
