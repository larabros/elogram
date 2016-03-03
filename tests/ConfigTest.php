<?php

namespace Instagram\Tests\Http;

use Instagram\Config;
use Instagram\Tests\TestCase;
use League\OAuth2\Client\Token\AccessToken;

class ConfigTest extends TestCase
{
    protected $config;

    protected function setUp()
    {
        $this->config = new Config([]);
    }

    /**
     * @covers Instagram\Config::__construct()
     * @covers Instagram\Config::getDefaults()
     * @covers Instagram\Config::get()
     */
    public function testCreateWithoutAccessToken()
    {
        $this->assertNull($this->config->get('access_token'));
    }

    /**
     * @covers Instagram\Config::__construct()
     * @covers Instagram\Config::getDefaults()
     * @covers Instagram\Config::get()
     */
    public function testCreateWithAccessToken()
    {
        $config = new Config(['access_token' => '{"access_token": "sometoken"}']);
        $this->assertInstanceOf(AccessToken::class, $config->get('access_token'));
    }
}
