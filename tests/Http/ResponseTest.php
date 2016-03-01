<?php

namespace Instagram\Tests\Http;

use Instagram\Http\Response;
use Instagram\Tests\TestCase;

class ResponseTest extends TestCase
{
    protected $response;

    protected function setUp()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/../fixtures/get_media.json'), true);
        $this->response = new Response($data['meta'], $data['data']);
    }

    /**
     * @covers Instagram\Http\Response::createFromJson()
     * @covers Instagram\Http\Response::__construct()
     */
    public function testCreateFromJson()
    {
        $response = Response::createFromJson(json_decode(file_get_contents(__DIR__ . '/../fixtures/get_media.json'), true));
        $this->assertEquals($this->response, $response);
    }

    /**
     * @covers Instagram\Http\Response::__construct()
     * @covers Instagram\Http\Response::getRaw()
     */
    public function testGetRaw()
    {
        $raw = $this->response->getRaw();
        $this->assertArrayHasKey('meta', $raw);
        $this->assertEquals(200, $raw['meta']['code']);
    }

    /**
     * @covers Instagram\Http\Response::__construct()
     * @covers Instagram\Http\Response::get()
     */
    public function testGet()
    {
        $this->assertEquals('image', $this->response->get()['type']);
    }

    /**
     * @covers Instagram\Http\Response::__construct()
     * @covers Instagram\Http\Response::nextUrl()
     * @covers Instagram\Http\Response::hasPages()
     */
    public function testNextUrl()
    {
        $response = Response::createFromJson(json_decode(file_get_contents(__DIR__ . '/../fixtures/get_users_follows.json'), true));
        $this->assertTrue($response->hasPages());
        $this->assertStringStartsWith('http', $response->nextUrl());
    }

    /**
     * @covers Instagram\Http\Response::__construct()
     * @covers Instagram\Http\Response::nextUrl()
     * @covers Instagram\Http\Response::hasPages()
     */
    public function testNextWithNoPagination()
    {
        $this->assertFalse($this->response->hasPages());
        $this->assertNull($this->response->nextUrl());
    }

    /**
     * @covers Instagram\Http\Response::__construct()
     * @covers Instagram\Http\Response::__toString()
     */
    public function testToString()
    {
        $this->assertJsonStringEqualsJsonString(file_get_contents(__DIR__ . '/../fixtures/get_media.json'), (string) $this->response);
    }
}
