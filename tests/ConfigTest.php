<?php

namespace Larabros\Elogram\Tests\Http;

use Larabros\Elogram\Config;
use Larabros\Elogram\Tests\TestCase;
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
     * @covers Larabros\Elogram\Config::__construct()
     * @covers Larabros\Elogram\Config::getDefaults()
     * @covers Larabros\Elogram\Config::get()
     */
    public function testCreateWithoutAccessToken()
    {
        $this->assertEquals('https://api.instagram.com/v1/', $this->config->get('base_uri'));
        $this->assertNull($this->config->get('access_token'));
    }
}
