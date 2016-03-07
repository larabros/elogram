<?php

namespace Instagram\Tests;

use Instagram\Config;
use Instagram\Entities\Comment;
use Instagram\Entities\LikeRepository;
use Instagram\Entities\Location;
use Instagram\Entities\Media;
use Instagram\Entities\Tag;
use Instagram\Entities\User;
use Instagram\Helpers\LoginHelperInterface;
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
        $this->instagram = new Instagram('foo', 'bar', null, '/');
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
     * @covers Instagram\Instagram::getLoginHelper()
     * @runInSeparateProcess
     */
    public function testGetLoginHelper()
    {
        $this->assertInstanceOf(LoginHelperInterface::class, $this->instagram->getLoginHelper());
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::users()
     */
    public function testUsers()
    {
        $instagram = new Instagram('foo', 'bar', '{"access_token": "baz"}', '/');
        $users     = $instagram->users();
        $this->assertInstanceOf(User::class, $users);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::media()
     */
    public function testMedia()
    {
        $instagram = new Instagram('foo', 'bar', '{"access_token": "baz"}', '/');
        $media     = $instagram->media();
        $this->assertInstanceOf(Media::class, $media);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::comments()
     */
    public function testComments()
    {
        $instagram = new Instagram('foo', 'bar', '{"access_token": "baz"}', '/');
        $comments  = $instagram->comments();
        $this->assertInstanceOf(Comment::class, $comments);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::likes()
     */
    public function testLikes()
    {
        $instagram = new Instagram('foo', 'bar', '{"access_token": "baz"}', '/');
        $likes     = $instagram->likes();
        $this->assertInstanceOf(LikeRepository::class, $likes);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::tags()
     */
    public function testTags()
    {
        $instagram = new Instagram('foo', 'bar', '{"access_token": "baz"}', '/');
        $tags      = $instagram->tags();
        $this->assertInstanceOf(Tag::class, $tags);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::locations()
     */
    public function testLocations()
    {
        $instagram = new Instagram('foo', 'bar', '{"access_token": "baz"}', '/');
        $locations = $instagram->locations();
        $this->assertInstanceOf(Location::class, $locations);
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::buildContainer()
     * @covers Instagram\Instagram::paginate()
     */
    public function testPaginate()
    {
        $this->markTestIncomplete();
    }
}
