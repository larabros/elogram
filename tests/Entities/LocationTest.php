<?php

namespace Instagram\Tests\Entities;

use Instagram\Entities\Location;
use Instagram\Http\Client\MockAdapter;
use Instagram\Tests\TestCase;

class LocationTest extends TestCase
{
    /**
     * @var Location
     */
    protected $location;

    protected function setUp()
    {
        $this->location = new Location(new MockAdapter(realpath(__DIR__.'/../fixtures/').'/'));
    }

    /**
     * @covers Instagram\Entities\Location::__construct()
     * @covers Instagram\Entities\Location::get()
     */
    public function testGet()
    {
        $response = $this->location->get('1')->get();
        $this->assertArrayHasKey('name', $response);
    }

    /**
     * @covers Instagram\Entities\Location::__construct()
     * @covers Instagram\Entities\Location::getRecentMedia()
     */
    public function testGetRecentMedia()
    {
        $response = $this->location->getRecentMedia('514276')->get();
        $this->assertCount(2, $response);
    }

    /**
     * @covers Instagram\Entities\Location::__construct()
     * @covers Instagram\Entities\Location::search()
     */
    public function testSearch()
    {
        $response = $this->location->search(48.858325999999998, 2.294505)->get();
        $this->assertCount(3, $response);
    }
}
