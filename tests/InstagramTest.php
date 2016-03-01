<?php

namespace Instagram\Tests\Http;

use Instagram\Config;
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
     * @runInSeparateProcess
     */
    public function testGetClient()
    {
        $instagram = new Instagram('foo', 'bar', '{"access_token": "baz"}', '/');
        $this->assertInstanceOf(AdapterInterface::class, $instagram->getClient());
    }
}
