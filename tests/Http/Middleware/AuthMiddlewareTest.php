<?php

namespace Instagram\Tests\Http\Middleware;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Instagram\Http\Middleware\AuthMiddleware;
use Instagram\Tests\TestCase;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\RequestInterface;

class AuthMiddlewareTest extends TestCase
{
    /**
     * @covers Instagram\Http\Middleware\AuthMiddleware::create()
     * @covers Instagram\Http\Middleware\AuthMiddleware::__construct()
     * @covers Instagram\Http\Middleware\AuthMiddleware::__invoke()
     */
    public function testAddsContentTypeHeader()
    {
        $token = new AccessToken(['access_token' => 'token']);
        $handler = new MockHandler([
            function (RequestInterface $request) {
                $this->assertTrue($request->hasHeader('Content-Type'));
                $this->assertEquals('application/json', $request->getHeaderLine('Content-Type'));
                return new Response(200);
            }
        ]);
        $middleware = AuthMiddleware::create($token);
        $stack      = new HandlerStack($handler);
        $stack->push($middleware);
        $client = new Client(['handler' => $stack]);
        $client->get('http://google.com');
    }

    /**
     * @covers Instagram\Http\Middleware\AuthMiddleware::create()
     * @covers Instagram\Http\Middleware\AuthMiddleware::__construct()
     * @covers Instagram\Http\Middleware\AuthMiddleware::__invoke()
     */
    public function testAddsAccessToken()
    {
        $token = new AccessToken(['access_token' => 'token']);
        $handler = new MockHandler([
            function (RequestInterface $request) {
                $query = [];
                parse_str($request->getUri()->getQuery(), $query);

                $this->assertArrayHasKey('access_token', $query);
                $this->assertEquals('token', $query['access_token']);
                return new Response(200);
            }
        ]);
        $middleware = AuthMiddleware::create($token);
        $stack      = new HandlerStack($handler);
        $stack->push($middleware);
        $client = new Client(['handler' => $stack]);
        $client->get('http://google.com');
    }
}
