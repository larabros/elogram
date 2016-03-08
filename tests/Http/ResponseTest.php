<?php

namespace Larabros\Elogram\Tests\Http;

use Illuminate\Support\Collection;
use Larabros\Elogram\Exceptions\IncompatibleResponseException;
use Larabros\Elogram\Http\Response;
use Larabros\Elogram\Tests\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @var Response
     */
    protected $response;

    protected function setUp()
    {
        $data           = $this->getFixture('get_media.json');
        $this->response = new Response($data['meta'], $data['data']);
    }

    /**
     * @covers Larabros\Elogram\Http\Response::createFromJson()
     * @covers Larabros\Elogram\Http\Response::__construct()
     */
    public function testCreateFromJson()
    {
        $response = Response::createFromJson($this->getFixture('get_media.json'));
        $this->assertEquals($this->response, $response);
    }

    /**
     * @covers Larabros\Elogram\Http\Response::__construct()
     * @covers Larabros\Elogram\Http\Response::getRaw()
     */
    public function testGetRaw()
    {
        $raw = $this->response->getRaw();
        $this->assertArrayHasKey('meta', $raw);
        $this->assertEquals(200, $raw['meta']['code']);
    }

    /**
     * @covers Larabros\Elogram\Http\Response::__construct()
     * @covers Larabros\Elogram\Http\Response::get()
     * @covers Larabros\Elogram\Http\Response::isCollection()
     * @covers Larabros\Elogram\Http\Response::isRecord()
     */
    public function testGet()
    {
        $this->assertEquals('image', $this->response->get()['type']);
        $this->assertFalse($this->response->get() instanceof Collection);
    }

    /**
     * @covers Larabros\Elogram\Http\Response::__construct()
     * @covers Larabros\Elogram\Http\Response::get()
     * @covers Larabros\Elogram\Http\Response::isCollection()
     * @covers Larabros\Elogram\Http\Response::isRecord()
     */
    public function testGetCollection()
    {
        $response = Response::createFromJson($this->getFixture('get_users_follows.json'));
        $this->assertTrue($response->get() instanceof Collection);
    }

    /**
     * @covers Larabros\Elogram\Http\Response::__construct()
     * @covers Larabros\Elogram\Http\Response::merge()
     * @covers Larabros\Elogram\Http\Response::isCollection()
     * @covers Larabros\Elogram\Http\Response::isRecord()
     */
    public function testMergeCollections()
    {
        $response = Response::createFromJson($this->getFixture('get_users_follows.json'));
        $merged   = $response->merge($response);
        $this->assertCount(100, $merged->get());
        $this->assertTrue($merged->get() instanceof Collection);
    }

    /**
     * @covers Larabros\Elogram\Http\Response::__construct()
     * @covers Larabros\Elogram\Http\Response::merge()
     * @covers Larabros\Elogram\Http\Response::isCollection()
     * @covers Larabros\Elogram\Http\Response::isRecord()
     */
    public function testMergeRecords()
    {
        $merged = $this->response->merge($this->response);
        $this->assertCount(2, $merged->get());
        $this->assertTrue($merged->get() instanceof Collection);
    }

    /**
     * @covers Larabros\Elogram\Http\Response::__construct()
     * @covers Larabros\Elogram\Http\Response::merge()
     * @covers Larabros\Elogram\Http\Response::isCollection()
     * @covers Larabros\Elogram\Http\Response::isRecord()
     */
    public function testMergeFailure()
    {
        $response = Response::createFromJson($this->getFixture('get_users_follows.json'));
        $this->setExpectedException(IncompatibleResponseException::class);
        $this->response->merge($response);
    }

    /**
     * @covers Larabros\Elogram\Http\Response::__construct()
     * @covers Larabros\Elogram\Http\Response::get()
     * @covers Larabros\Elogram\Http\Response::isCollection()
     * @covers Larabros\Elogram\Http\Response::isRecord()
     */
    public function testGetNullResponse()
    {
        $meta     = $this->response->getRaw()['meta'];
        $response = new Response($meta, null);
        $this->assertNull($response->get());
    }

    /**
     * @covers Larabros\Elogram\Http\Response::__construct()
     * @covers Larabros\Elogram\Http\Response::nextUrl()
     * @covers Larabros\Elogram\Http\Response::hasPages()
     */
    public function testNextUrl()
    {
        $response = Response::createFromJson($this->getFixture('get_users_follows.json'));
        $this->assertTrue($response->hasPages());
        $this->assertStringStartsWith('http', $response->nextUrl());
    }

    /**
     * @covers Larabros\Elogram\Http\Response::__construct()
     * @covers Larabros\Elogram\Http\Response::nextUrl()
     * @covers Larabros\Elogram\Http\Response::hasPages()
     */
    public function testNextWithNoPagination()
    {
        $this->assertFalse($this->response->hasPages());
        $this->assertNull($this->response->nextUrl());
    }

    /**
     * @covers Larabros\Elogram\Http\Response::__construct()
     * @covers Larabros\Elogram\Http\Response::__toString()
     */
    public function testToString()
    {
        $this->assertJsonStringEqualsJsonString(file_get_contents(__DIR__ . '/../fixtures/get_media.json'), (string) $this->response);
    }
}
