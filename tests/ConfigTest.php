<?php

namespace Instagram\Tests\Http;

use Instagram\Config;
use Instagram\Tests\TestCase;

class ConfigTest extends TestCase
{
    protected $config;

    protected function setUp()
    {
        $this->config = new Config();
    }

    public function testCreateWithoutAccessToken()
    {
        $this->markTestIncomplete();
    }

    public function testCreateWithAccessToken()
    {
        $this->markTestIncomplete();
    }
}
