<?php

namespace Instagram\Tests;

use Instagram\Http\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    protected $response;

    protected function setUp()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/../fixtures/single-result.json'), true);
        $this->response = new Response($data['meta'], $data['data']);
    }

    protected function tearDown()
    {
    }

    public function testCreateFromJson()
    {
        $response = Response::createFromResponse(json_decode(file_get_contents(__DIR__ . '/../fixtures/single-result.json'), true));
        $this->assertEquals($this->response, $response);
    }

    public function testGetRaw()
    {
        $raw = $this->response->getRaw();
        $this->assertArrayHasKey('meta', $raw);
        $this->assertEquals(200, $raw['meta']['code']);
    }

    public function testGet()
    {
        $this->assertEquals('image', $this->response->get()['type']);
    }

    public function testNext()
    {
        $this->markTestIncomplete();
    }

    public function testNextWithNoPagination()
    {
        $this->assertNull($this->response->next());
    }

    public function testToString()
    {
        $this->markTestIncomplete();
    }
}
