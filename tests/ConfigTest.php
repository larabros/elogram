<?php

namespace Elogram\Tests\Http;

use Elogram\Config;
use Elogram\Tests\TestCase;
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
     * @covers Elogram\Config::__construct()
     * @covers Elogram\Config::getDefaults()
     * @covers Elogram\Config::get()
     */
    public function testCreateWithoutAccessToken()
    {
        $this->assertEquals('https://api.instagram.com/v1/', $this->config->get('base_uri'));
        $this->assertNull($this->config->get('access_token'));
    }
}
