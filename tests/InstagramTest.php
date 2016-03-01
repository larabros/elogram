<?php

namespace Instagram\Tests\Http;

use Instagram\Config;
use Instagram\Entities\Media;
use Instagram\Entities\User;
use Instagram\Helpers\LoginHelperInterface;
use Instagram\Http\Client\AdapterInterface;
use Instagram\Instagram;
use Instagram\Tests\TestCase;

class InstagramTest extends TestCase
{
    /**
     * @var Instagram
     */
    protected $instagram;

    protected function setUp()
    {
        $this->instagram = new Instagram('foo', 'bar', null, '/');
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::createConfig()
     * @covers Instagram\Instagram::registerServiceProviders()
     * @covers Instagram\Instagram::getConfig()
     */
    public function testGetConfig()
    {
        $this->assertInstanceOf(Config::class, $this->instagram->getConfig());
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::createConfig()
     * @covers Instagram\Instagram::registerServiceProviders()
     * @covers Instagram\Instagram::getLoginHelper()
     * @runInSeparateProcess
     */
    public function testGetLoginHelper()
    {
        $this->assertInstanceOf(LoginHelperInterface::class, $this->instagram->getLoginHelper());
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::createConfig()
     * @covers Instagram\Instagram::registerServiceProviders()
     * @covers Instagram\Instagram::getClient()
     */
    public function testGetClient()
    {
        $instagram = new Instagram('foo', 'bar', '{"access_token": "baz"}', '/');
        $this->assertInstanceOf(AdapterInterface::class, $instagram->getClient());
    }

    /**
     * @covers Instagram\Instagram::__construct()
     * @covers Instagram\Instagram::createConfig()
     * @covers Instagram\Instagram::registerServiceProviders()
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
     * @covers Instagram\Instagram::createConfig()
     * @covers Instagram\Instagram::registerServiceProviders()
     * @covers Instagram\Instagram::media()
     */
    public function testMedia()
    {
        $instagram = new Instagram('foo', 'bar', '{"access_token": "baz"}', '/');
        $media     = $instagram->media();
        $this->assertInstanceOf(Media::class, $media);
    }
}
