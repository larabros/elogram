<?php

namespace Larabros\Elogram\Tests\Http\Clients;

use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Tests\TestCase;
use Mockery as m;

class MockAdapterTest extends TestCase
{
    /**
     * @var MockAdapter
     */
    protected $adapter;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->adapter = new MockAdapter($this->getFixturesPath());
    }

    /**
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::__construct()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::request()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::mapRequestToFile()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::cleanPath()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::mapRequestParameters()
     */
    public function testRequest()
    {
        $expected = $this->getFixture('get_users_search.json', false);
        $actual   = $this->adapter->request('GET', 'users/search');
        $this->assertJsonStringEqualsJsonString((string) $actual, $expected);
    }

    /**
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::__construct()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::request()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::mapRequestToFile()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::cleanPath()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::mapRequestParameters()
     */
    public function testRequestWithParameters()
    {
        $expected = $this->getFixture('get_locations_search_facebook_places_id.json', false);
        $actual   = $this->adapter->request('GET', 'locations/search', [
            'query' => ['facebook_places_id' => 'lalala']
        ]);
        $this->assertJsonStringEqualsJsonString((string) $actual, $expected);
    }

    /**
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::__construct()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::paginate()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::request()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::mapRequestToFile()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::cleanPath()
     * @covers Larabros\Elogram\Http\Clients\MockAdapter::mapRequestParameters()
     */
    public function testPaginateWithLimit()
    {
        $response = $this->adapter->request('GET', 'users/self/follows');
        $this->assertTrue($response->hasPages());
        $this->assertCount(50, $response->get());

        $paged = $this->adapter->paginate($response, 2);
        $this->assertTrue($paged->hasPages());
        $this->assertCount(150, $paged->get());
    }
}
