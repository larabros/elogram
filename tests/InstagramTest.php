<?php

namespace Instagram\Tests;

use Instagram\Config;
use Instagram\Entities\Comment;
use Instagram\Entities\LikeRepository;
use Instagram\Entities\Location;
use Instagram\Entities\Media;
use Instagram\Entities\Tag;
use Instagram\Entities\User;
use Instagram\Helpers\RedirectLoginHelper;
use Instagram\Http\Clients\MockAdapter;
use Instagram\Http\Response;
use Instagram\Instagram;

class InstagramTest extends TestCase
{
    /**
     * @var Instagram
     */
    protected $instagram;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $options = [
//            'session_store' => NativeSessionStore::class,
            'http_adapter'  => MockAdapter::class,
        ];
        $this->instagram = new Instagram('foo', 'bar', '{"access_token": "baz"}', '/', $options);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::getConfig()
     */
    public function testGetConfig()
    {
        $this->assertInstanceOf(Config::class, $this->instagram->getConfig());
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::users()
     */
    public function testUsers()
    {
        $users = $this->instagram->users();
        $this->assertInstanceOf(User::class, $users);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::media()
     */
    public function testMedia()
    {
        $media = $this->instagram->media();
        $this->assertInstanceOf(Media::class, $media);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::comments()
     */
    public function testComments()
    {
        $comments = $this->instagram->comments();
        $this->assertInstanceOf(Comment::class, $comments);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::likes()
     */
    public function testLikes()
    {
        $likes = $this->instagram->likes();
        $this->assertInstanceOf(LikeRepository::class, $likes);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::tags()
     */
    public function testTags()
    {
        $tags = $this->instagram->tags();
        $this->assertInstanceOf(Tag::class, $tags);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::locations()
     */
    public function testLocations()
    {
        $locations = $this->instagram->locations();
        $this->assertInstanceOf(Location::class, $locations);
    }
}
