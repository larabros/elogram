<?php

namespace Instagram\Tests\Http\Client;

use Instagram\Tests\TestCase;

class GuzzleAdapterTest extends TestCase
{
    protected $adapter;

    protected function setUp()
    {
        // $data = json_decode(file_get_contents(__DIR__ . '/../fixtures/single-result.json'), true);
        // $this->adapter = new Response($data['meta'], $data['data']);
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::request()
     */
    public function testRequest()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::request()
     */
    public function testBadRequest()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::paginate()
     */
    public function testPaginateSingleResponse()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::paginate()
     */
    public function testPaginate()
    {
        $this->markTestIncomplete('Not yet implemented');
    }
}
