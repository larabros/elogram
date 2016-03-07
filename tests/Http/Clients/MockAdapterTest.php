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
     */
    public function testPaginate()
    {
        $actual = $this->adapter->request('GET', 'users/search');
        $this->assertJsonStringEqualsJsonString((string) $actual, (string) $this->adapter->paginate($actual));
    }
}
