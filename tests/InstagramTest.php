<?php

namespace Elogram\Tests;

use Elogram\Config;
use Elogram\Entities\Comment;
use Elogram\Entities\LikeRepository;
use Elogram\Entities\Location;
use Elogram\Entities\Media;
use Elogram\Entities\Tag;
use Elogram\Entities\User;
use Elogram\Helpers\RedirectLoginHelper;
use Elogram\Http\Clients\MockAdapter;
use Elogram\Http\Response;
use Elogram\Instagram;

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
     * @covers Elogram\Instagram::__construct()
     * @covers Elogram\Instagram::buildContainer()
     * @covers Elogram\Instagram::getConfig()
     */
    public function testGetConfig()
    {
        $this->assertInstanceOf(Config::class, $this->instagram->getConfig());
    }

    /**
     * @covers Elogram\Instagram::__construct()
     * @covers Elogram\Instagram::buildContainer()
     * @covers Elogram\Instagram::users()
     */
    public function testUsers()
    {
        $users = $this->instagram->users();
        $this->assertInstanceOf(User::class, $users);
    }

    /**
     * @covers Elogram\Instagram::__construct()
     * @covers Elogram\Instagram::buildContainer()
     * @covers Elogram\Instagram::media()
     */
    public function testMedia()
    {
        $media = $this->instagram->media();
        $this->assertInstanceOf(Media::class, $media);
    }

    /**
     * @covers Elogram\Instagram::__construct()
     * @covers Elogram\Instagram::buildContainer()
     * @covers Elogram\Instagram::comments()
     */
    public function testComments()
    {
        $comments = $this->instagram->comments();
        $this->assertInstanceOf(Comment::class, $comments);
    }

    /**
     * @covers Elogram\Instagram::__construct()
     * @covers Elogram\Instagram::buildContainer()
     * @covers Elogram\Instagram::likes()
     */
    public function testLikes()
    {
        $likes = $this->instagram->likes();
        $this->assertInstanceOf(LikeRepository::class, $likes);
    }

    /**
     * @covers Elogram\Instagram::__construct()
     * @covers Elogram\Instagram::buildContainer()
     * @covers Elogram\Instagram::tags()
     */
    public function testTags()
    {
        $tags = $this->instagram->tags();
        $this->assertInstanceOf(Tag::class, $tags);
    }

    /**
     * @covers Elogram\Instagram::__construct()
     * @covers Elogram\Instagram::buildContainer()
     * @covers Elogram\Instagram::locations()
     */
    public function testLocations()
    {
        $locations = $this->instagram->locations();
        $this->assertInstanceOf(Location::class, $locations);
    }
}
