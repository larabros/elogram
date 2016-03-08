<?php

namespace Elogram\Tests\Http\Middleware;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Elogram\Config;
use Elogram\Http\Middleware\AuthMiddleware;
use Elogram\Tests\TestCase;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\RequestInterface;

class AuthMiddlewareTest extends TestCase
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $token = new AccessToken(json_decode('{"access_token":"fb2e77d.47a0479900504cb3ab4a1f626d174d2d"}', true));
        $this->config = new Config([
            'client_id' => 'CS',
            'client_secret' => '6dc1787668c64c939929c17683d7cb74',
            'access_token'  => $token,
        ]);
    }

    /**
     * @covers Elogram\Http\Middleware\AuthMiddleware::create()
     * @covers Elogram\Http\Middleware\AuthMiddleware::__construct()
     * @covers Elogram\Http\Middleware\AuthMiddleware::__invoke()
     * @covers Elogram\Http\Middleware\AbstractMiddleware::__invoke()
     */
    public function testAddsContentTypeHeader()
    {
        $handler = new MockHandler([
            function (RequestInterface $request) {
                $this->assertTrue($request->hasHeader('Content-Type'));
                $this->assertEquals('application/json', $request->getHeaderLine('Content-Type'));
                return new Response(200);
            }
        ]);

        $middleware = AuthMiddleware::create($this->config);
        $stack      = new HandlerStack($handler);
        $stack->push($middleware);
        $client = new Client(['handler' => $stack]);
        $client->get('http://google.com');
    }

    /**
     * @covers Elogram\Http\Middleware\AuthMiddleware::create()
     * @covers Elogram\Http\Middleware\AuthMiddleware::__construct()
     * @covers Elogram\Http\Middleware\AuthMiddleware::__invoke()
     * @covers Elogram\Http\Middleware\AbstractMiddleware::__invoke()
     */
    public function testAddsAccessToken()
    {
        $handler = new MockHandler([
            function (RequestInterface $request) {
                $query = [];
                parse_str($request->getUri()->getQuery(), $query);

                $this->assertArrayHasKey('access_token', $query);
                $this->assertEquals('fb2e77d.47a0479900504cb3ab4a1f626d174d2d', $query['access_token']);
                return new Response(200);
            }
        ]);

        $middleware = AuthMiddleware::create($this->config);
        $stack      = new HandlerStack($handler);
        $stack->push($middleware);
        $client = new Client(['handler' => $stack]);
        $client->get('http://google.com');
    }

    /**
     * @covers Elogram\Http\Middleware\AuthMiddleware::create()
     * @covers Elogram\Http\Middleware\AuthMiddleware::__construct()
     * @covers Elogram\Http\Middleware\AuthMiddleware::__invoke()
     * @covers Elogram\Http\Middleware\AbstractMiddleware::__invoke()
     */
    public function testDoesNotAddAccessToken()
    {
        $this->config->set('access_token', null);
        $handler = new MockHandler([
            function (RequestInterface $request) {
                $query = [];
                parse_str($request->getUri()->getQuery(), $query);

                $this->assertArrayNotHasKey('access_token', $query);
                return new Response(200);
            }
        ]);

        $middleware = AuthMiddleware::create($this->config);
        $stack      = new HandlerStack($handler);
        $stack->push($middleware);
        $client = new Client(['handler' => $stack]);
        $client->get('http://google.com');
    }
}
