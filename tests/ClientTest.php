<?php

namespace Larabros\Elogram\Tests;

use Larabros\Elogram\Config;
use Larabros\Elogram\Entities\Comment;
use Larabros\Elogram\Entities\LikeRepository;
use Larabros\Elogram\Entities\Location;
use Larabros\Elogram\Entities\Media;
use Larabros\Elogram\Entities\Tag;
use Larabros\Elogram\Entities\User;
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
        $this->assertInstanceOf(User::class, $users);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::media()
     */
    public function testMedia()
    {
        $media = $this->client->media();
        $this->assertInstanceOf(Media::class, $media);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::comments()
     */
    public function testComments()
    {
        $comments = $this->client->comments();
        $this->assertInstanceOf(Comment::class, $comments);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::likes()
     */
    public function testLikes()
    {
        $likes = $this->client->likes();
        $this->assertInstanceOf(LikeRepository::class, $likes);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::tags()
     */
    public function testTags()
    {
        $tags = $this->client->tags();
        $this->assertInstanceOf(Tag::class, $tags);
    }

    /**
     * @covers Larabros\Elogram\Client::__construct()
     * @covers Larabros\Elogram\Client::buildContainer()
     * @covers Larabros\Elogram\Client::locations()
     */
    public function testLocations()
    {
        $locations = $this->client->locations();
        $this->assertInstanceOf(Location::class, $locations);
    }
}
