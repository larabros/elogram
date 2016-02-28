<?php

namespace Instagram\Tests\Http\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
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
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Client\GuzzleAdapter::request()
     */
    public function testRequest()
    {
        $json     = file_get_contents(realpath(__DIR__ . '/../../fixtures/single-result.json'));
        $response = new Response(200, [], $json);
        $this->guzzleMock->shouldReceive('request')->once()->andReturn($response);

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
        $exception = new ClientException('test', new Request('GET', '['));
        $this->guzzleMock->shouldReceive('request')->once()->andThrow($exception);
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
        $this->guzzleMock->shouldReceive('request')->once()->andReturn($response);

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
        $first      = file_get_contents(realpath(__DIR__ . '/../../fixtures/first-result.json'));
        $firstPage  = new Response(200, [], $first);
        $secondPage = new Response(200, [], $first);
        $thirdPage  = new Response(200, [], $first);
        $fourthPage = new Response(200, [], $first);

        $last     = file_get_contents(realpath(__DIR__ . '/../../fixtures/single-result.json'));
        $lastPage = new Response(200, [], $last);

        $this->guzzleMock->shouldReceive('request')
            ->zeroOrMoreTimes()
            ->andReturn($firstPage, $secondPage, $thirdPage, $fourthPage, $lastPage);

        $adapter   = new GuzzleAdapter($this->guzzleMock);
        $response  = $adapter->request('GET', '/');
        $this->assertTrue($response->hasPages());

        $paginatedResponse = $adapter->paginate($response);
        $this->assertFalse($paginatedResponse->hasPages());
    }
}
