<?php

namespace Instagram\Tests\Http\Clients;

use Instagram\Http\Clients\MockAdapter;
use Instagram\Tests\TestCase;
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
     * @covers Instagram\Http\Clients\MockAdapter::__construct()
     * @covers Instagram\Http\Clients\MockAdapter::request()
     * @covers Instagram\Http\Clients\MockAdapter::mapRequestToFile()
     * @covers Instagram\Http\Clients\MockAdapter::cleanPath()
     * @covers Instagram\Http\Clients\MockAdapter::mapRequestParameters()
     */
    public function testRequest()
    {
        $expected = $this->getFixture('get_users_search.json', false);
        $actual   = $this->adapter->request('GET', 'users/search');
        $this->assertJsonStringEqualsJsonString((string) $actual, $expected);
    }

    /**
     * @covers Instagram\Http\Clients\MockAdapter::__construct()
     * @covers Instagram\Http\Clients\MockAdapter::request()
     * @covers Instagram\Http\Clients\MockAdapter::mapRequestToFile()
     * @covers Instagram\Http\Clients\MockAdapter::cleanPath()
     * @covers Instagram\Http\Clients\MockAdapter::mapRequestParameters()
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
     * @covers Instagram\Http\Clients\MockAdapter::__construct()
     * @covers Instagram\Http\Clients\MockAdapter::paginate()
     * @covers Instagram\Http\Clients\MockAdapter::request()
     * @covers Instagram\Http\Clients\MockAdapter::mapRequestToFile()
     * @covers Instagram\Http\Clients\MockAdapter::cleanPath()
     * @covers Instagram\Http\Clients\MockAdapter::mapRequestParameters()
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
