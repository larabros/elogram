<?php

namespace Instagram\Tests\Http\Client;

use Instagram\Http\Client\MockAdapter;
use Instagram\Tests\TestCase;
use Mockery as m;

class MockAdapterTest extends TestCase
{
    /**
     * @covers Instagram\Http\Client\MockAdapter::__construct()
     * @covers Instagram\Http\Client\MockAdapter::request()
     * @covers Instagram\Http\Client\MockAdapter::mapRequestToFile()
     * @covers Instagram\Http\Client\MockAdapter::mapRequestParameters()
     */
    public function testRequest()
    {
        $path = realpath(__DIR__.'/../../fixtures/').'/';
        $adapter = new MockAdapter($path);

        $expected = file_get_contents($path.'get_users_search.json');
        $actual = $adapter->request('GET', 'users/search');
        $this->assertJsonStringEqualsJsonString((string) $actual, $expected);
    }

    /**
     */
    public function testPaginate()
    {
        $this->markTestIncomplete();
    }
}
