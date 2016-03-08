<?php

namespace Elogram\Tests\Http\Clients;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Elogram\Exceptions\Exception as InstagramException;
use Elogram\Exceptions\OAuthParameterException;
use Elogram\Http\Clients\GuzzleAdapter;
use Elogram\Tests\TestCase;
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
     * @covers Elogram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Elogram\Http\Clients\GuzzleAdapter::request()
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
     * @covers Elogram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Elogram\Http\Clients\GuzzleAdapter::paginate()
     * @covers Elogram\Http\Clients\GuzzleAdapter::request()
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
     * @covers Elogram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Elogram\Http\Clients\GuzzleAdapter::paginate()
     * @covers Elogram\Http\Clients\GuzzleAdapter::request()
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
     * @covers Elogram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Elogram\Http\Clients\GuzzleAdapter::paginate()
     * @covers Elogram\Http\Clients\GuzzleAdapter::request()
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

    /**
     * @covers Elogram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Elogram\Http\Clients\GuzzleAdapter::request()
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
     * @covers Elogram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Elogram\Http\Clients\GuzzleAdapter::request()
     * @covers Elogram\Http\Clients\AbstractAdapter::resolveExceptionClass()
     */
    public function testRequestWithSomethingWrong()
    {
        $exception = new ClientException(
            'test',
            new Request('GET', '['),
            new Response(200, [], null)
        );
        $this->guzzleMock->shouldReceive('request')->once()->andThrow($exception);
        $adapter = new GuzzleAdapter($this->guzzleMock);
        $this->setExpectedException(InstagramException::class);
        $adapter->request('GET', '[');
    }

    /**
     * @covers Elogram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Elogram\Http\Clients\GuzzleAdapter::request()
     * @covers Elogram\Http\Clients\AbstractAdapter::resolveExceptionClass()
     */
    public function testRequestWithMissingParameters()
    {
        $error = [
            'error_type'    => 'OAuthParameterException',
            'error_message' => 'Missing parameter',
        ];
        $exception = new ClientException(
            'test',
            new Request('GET', '['),
            new Response(200, [], json_encode($error))
        );
        $this->guzzleMock->shouldReceive('request')->once()->andThrow($exception);
        $adapter = new GuzzleAdapter($this->guzzleMock);
        $this->setExpectedException(OAuthParameterException::class);
        $adapter->request('GET', '[');
    }

    /**
     * @covers Elogram\Http\Clients\GuzzleAdapter::__construct()
     * @covers Elogram\Http\Clients\GuzzleAdapter::request()
     */
    public function testBadResponse()
    {
        $exception = new Exception('Server exception');
        $this->guzzleMock->shouldReceive('request')->once()->andThrow($exception);
        $adapter = new GuzzleAdapter($this->guzzleMock);
        $this->setExpectedException(Exception::class);
        $adapter->request('GET', '[');
    }
}
