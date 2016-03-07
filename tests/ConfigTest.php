<?php

namespace Instagram\Tests\Http;

use Instagram\Config;
use Instagram\Tests\TestCase;
use League\OAuth2\Client\Token\AccessToken;

class ConfigTest extends TestCase
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * {@inheritDoc}
     */
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
        $this->assertEquals('https://api.instagram.com/v1/', $this->config->get('base_uri'));
        $this->assertNull($this->config->get('access_token'));
    }
}
