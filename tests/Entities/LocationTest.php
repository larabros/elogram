<?php

namespace Larabros\Elogram\Tests\Entities;

use Larabros\Elogram\Entities\Location;
use Larabros\Elogram\Http\Clients\MockAdapter;
use Larabros\Elogram\Tests\TestCase;

class LocationTest extends TestCase
{
    /**
     * @var Location
     */
    protected $location;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->location = new Location(new MockAdapter($this->getFixturesPath()));
    }

    /**
     * @covers Larabros\Elogram\Entities\Location::__construct()
     * @covers Larabros\Elogram\Entities\Location::get()
     */
    public function testGet()
    {
        $response = $this->location->get('1')->get();
        $this->assertArrayHasKey('name', $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\Location::__construct()
     * @covers Larabros\Elogram\Entities\Location::getRecentMedia()
     */
    public function testGetRecentMedia()
    {
        $response = $this->location->getRecentMedia('514276')->get();
        $this->assertCount(2, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\Location::__construct()
     * @covers Larabros\Elogram\Entities\Location::search()
     */
    public function testSearch()
    {
        $response = $this->location->search(48.858325999999998, 2.294505)->get();
        $this->assertCount(3, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\Location::__construct()
     * @covers Larabros\Elogram\Entities\Location::searchByFacebookPlacesId()
     */
    public function testSearchByFacebookPlacesId()
    {
        $response = $this->location->searchByFacebookPlacesId(114226462057675)->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Larabros\Elogram\Entities\Location::__construct()
     * @covers Larabros\Elogram\Entities\Location::searchByFoursquareId()
     */
    public function testSearchByFoursquareId()
    {
        $response = $this->location->searchByFoursquareId('51a2445e5019c80b56934c75')->get();
        $this->assertCount(1, $response);
    }
}
