<?php

namespace Elogram\Tests\Entities;

use Elogram\Entities\Location;
use Elogram\Http\Clients\MockAdapter;
use Elogram\Tests\TestCase;

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
     * @covers Elogram\Entities\Location::__construct()
     * @covers Elogram\Entities\Location::get()
     */
    public function testGet()
    {
        $response = $this->location->get('1')->get();
        $this->assertArrayHasKey('name', $response);
    }

    /**
     * @covers Elogram\Entities\Location::__construct()
     * @covers Elogram\Entities\Location::getRecentMedia()
     */
    public function testGetRecentMedia()
    {
        $response = $this->location->getRecentMedia('514276')->get();
        $this->assertCount(2, $response);
    }

    /**
     * @covers Elogram\Entities\Location::__construct()
     * @covers Elogram\Entities\Location::search()
     */
    public function testSearch()
    {
        $response = $this->location->search(48.858325999999998, 2.294505)->get();
        $this->assertCount(3, $response);
    }

    /**
     * @covers Elogram\Entities\Location::__construct()
     * @covers Elogram\Entities\Location::searchByFacebookPlacesId()
     */
    public function testSearchByFacebookPlacesId()
    {
        $response = $this->location->searchByFacebookPlacesId(114226462057675)->get();
        $this->assertCount(1, $response);
    }

    /**
     * @covers Elogram\Entities\Location::__construct()
     * @covers Elogram\Entities\Location::searchByFoursquareId()
     */
    public function testSearchByFoursquareId()
    {
        $response = $this->location->searchByFoursquareId('51a2445e5019c80b56934c75')->get();
        $this->assertCount(1, $response);
    }
}
