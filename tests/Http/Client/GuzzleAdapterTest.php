<?php

namespace Instagram\Tests\Http\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Instagram\Http\Client\GuzzleAdapter;
use Instagram\Tests\TestCase;
use Mockery as m;

class GuzzleAdapterTest extends TestCase
{
    protected $adapter;

    protected function setUp()
    {
        $this->adapter = new GuzzleAdapter(new Client(['base_uri' => 'https://httpbin.org/']));
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::__construct()
     * @covers Instagram\Http\Client\GuzzleAdapter::request()
     */
    public function testRequest()
    {
        $expected = ['meta' => ['code' => 200], 'data' => ['foo' => 'bar']];
        $actual   = $this->adapter->request('POST', '/post', ['json' => $expected]);
        $this->assertEquals($expected, json_decode($actual->get(), true));
    }

    /**
     * @covers Instagram\Http\Client\GuzzleAdapter::request()
     */
    public function testBadRequest()
    {
        $this->setExpectedException(ClientException::class);
        $this->adapter->request('GET', '/popopopop');
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
