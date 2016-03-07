<?php

namespace Instagram\Tests\Http\Clients;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Instagram\Http\Clients\GuzzleAdapter;
use Instagram\Tests\TestCase;
use Mockery as m;

class GuzzleAdapterTest extends TestCase
{
    protected $guzzleMock;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->guzzleMock = m::mock(Client::class);
    }

    /**
     * @covers Instagram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Clients\GuzzleAdapter::request()
     */
    public function testRequest()
    {
        $json     = $this->getFixture('get_media.json', false);
        $response = new Response(200, [], $json);
        $this->guzzleMock->shouldReceive('request')->once()->andReturn($response);

        $adapter  = new GuzzleAdapter($this->guzzleMock);
        $actual   = $adapter->request('GET', '/');
        $this->assertJsonStringEqualsJsonString($json, (string) $actual);
    }

    /**
     * @covers Instagram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Clients\GuzzleAdapter::request()
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
     * @covers Instagram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Clients\GuzzleAdapter::request()
     */
    public function testBadResponse()
    {
        $exception = new Exception('Server exception');
        $this->guzzleMock->shouldReceive('request')->once()->andThrow($exception);
        $adapter = new GuzzleAdapter($this->guzzleMock);
        $this->setExpectedException(Exception::class);
        $adapter->request('GET', '[');
    }

    /**
     * @covers Instagram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Clients\GuzzleAdapter::request()
     * @covers Instagram\Http\Clients\GuzzleAdapter::paginate()
     */
    public function testPaginateSingleResponse()
    {
        $json     = $this->getFixture('get_media.json', false);
        $response = new Response(200, [], $json);
        $this->guzzleMock->shouldReceive('request')->once()->andReturn($response);

        $adapter = new GuzzleAdapter($this->guzzleMock);
        $actual  = $adapter->paginate($adapter->request('GET', '/'));
        $this->assertFalse($actual->hasPages());
    }

    /**
     * @covers Instagram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Clients\GuzzleAdapter::request()
     * @covers Instagram\Http\Clients\GuzzleAdapter::paginate()
     */
    public function testPaginateWithLimit()
    {
        $first      = $this->getFixture('get_users_follows.json', false);
        $firstPage  = new Response(200, [], $first);
        $secondPage = new Response(200, [], $first);
        $thirdPage  = new Response(200, [], $first);
        $fourthPage = new Response(200, [], $first);

        $last       = json_decode($first, true);
        unset($last['pagination']);
        $lastPage   = new Response(200, [], json_encode($last));

        $this->guzzleMock->shouldReceive('request')
            ->zeroOrMoreTimes()
            ->andReturn($firstPage, $secondPage, $thirdPage, $fourthPage, $lastPage);

        $adapter   = new GuzzleAdapter($this->guzzleMock);
        $response  = $adapter->request('GET', '/');
        $this->assertTrue($response->hasPages());
        $this->assertCount(50, $response->get());

        $paginatedResponse = $adapter->paginate($response, 2);
        $this->assertTrue($paginatedResponse->hasPages());
        $this->assertCount(150, $paginatedResponse->get());
    }

    /**
     * @covers Instagram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Clients\GuzzleAdapter::request()
     * @covers Instagram\Http\Clients\GuzzleAdapter::paginate()
     */
    public function testPaginate()
    {
        $first      = $this->getFixture('get_users_follows.json', false);
        $firstPage  = new Response(200, [], $first);
        $secondPage = new Response(200, [], $first);
        $thirdPage  = new Response(200, [], $first);
        $fourthPage = new Response(200, [], $first);

        $last       = json_decode($first, true);
        unset($last['pagination']);
        $lastPage   = new Response(200, [], json_encode($last));

        $this->guzzleMock->shouldReceive('request')
            ->zeroOrMoreTimes()
            ->andReturn($firstPage, $secondPage, $thirdPage, $fourthPage, $lastPage);

        $adapter   = new GuzzleAdapter($this->guzzleMock);
        $response  = $adapter->request('GET', '/');
        $this->assertTrue($response->hasPages());
        $this->assertCount(50, $response->get());

        $paginatedResponse = $adapter->paginate($response);
        $this->assertFalse($paginatedResponse->hasPages());
        $this->assertCount(250, $paginatedResponse->get());
    }
}
