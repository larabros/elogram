<?php

namespace Instagram\Tests\Http\Client;

use Guzzle\Http\Message\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Instagram\Http\Client\GuzzleAdapter;
use Instagram\Tests\TestCase;
use Mockery as m;

class GuzzleAdapterTest extends TestCase
{
    protected $guzzleMock;

    protected function setUp()
    {
        $this->guzzleMock = m::mock(Client::class);
//        $this->guzzleMock->shouldReceive('get')->zeroOrMoreTimes();
//        $this->adapter = new GuzzleAdapter(new Client(['base_uri' => 'https://httpbin.org/']));
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Client\GuzzleAdapter::request()
     */
    public function testRequest()
    {
        $json     = file_get_contents(realpath(__DIR__ . '/../../fixtures/single-result.json'));
        $response = new Response(200, [], $json);
        $this->guzzleMock->shouldReceive('requestAsync')->once()->andReturn($response);

        $adapter  = new GuzzleAdapter($this->guzzleMock);
        $actual   = $adapter->request('GET', '/');
        $this->assertEquals($json, (string) $actual);
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Client\GuzzleAdapter::request()
     */
    public function testBadRequest()
    {
        $exception = new ClientException('test', new \GuzzleHttp\Psr7\Request('GET', '['));
        $this->guzzleMock->shouldReceive('requestAsync')->once()->andThrow($exception);
        $adapter = new GuzzleAdapter($this->guzzleMock);
        $this->setExpectedException(ClientException::class);
        $adapter->request('GET', '[');
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Client\GuzzleAdapter::request()
     * @covers Instagram\Http\Client\GuzzleAdapter::paginate()
     */
    public function testPaginateSingleResponse()
    {
        $json     = file_get_contents(realpath(__DIR__ . '/../../fixtures/single-result.json'));
        $response = new Response(200, [], $json);
        $this->guzzleMock->shouldReceive('requestAsync')->once()->andReturn($response);

        $adapter = new GuzzleAdapter($this->guzzleMock);
        $actual  = $adapter->paginate($adapter->request('GET', '/'));
        $this->assertFalse($actual->hasPages());
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Client\GuzzleAdapter::request()
     * @covers Instagram\Http\Client\GuzzleAdapter::paginate()
     */
    public function testPaginateWithLimit()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Client\GuzzleAdapter::request()
     * @covers Instagram\Http\Client\GuzzleAdapter::paginate()
     */
    public function testPaginate()
    {
        $this->markTestIncomplete('Not yet implemented');
    }
}
