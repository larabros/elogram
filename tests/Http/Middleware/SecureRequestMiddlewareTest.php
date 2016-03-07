<?php

namespace Instagram\Tests\Http\Middleware;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Instagram\Config;
use Instagram\Http\Middleware\SecureRequestMiddleware;
use Instagram\Tests\TestCase;
use Psr\Http\Message\RequestInterface;

class SecureRequestMiddlewareTest extends TestCase
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
        $this->config = new Config([
            'client_id' => 'CS',
            'client_secret' => '6dc1787668c64c939929c17683d7cb74',
            'access_token'  => '{"access_token":"fb2e77d.47a0479900504cb3ab4a1f626d174d2d"}',
            'secure_requests' => true,
        ]);
    }

    /**
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::create()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::__construct()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::__invoke()
     * @covers Instagram\Http\Middleware\AbstractMiddleware::__invoke()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::getParams()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::getPath()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::generateSig()
     */
    public function testGeneratesSigValue()
    {
        $handler = new MockHandler([
            function (RequestInterface $request) {
                $query = [];
                parse_str($request->getUri()->getQuery(), $query);

                $this->assertArrayHasKey('sig', $query);
                $this->assertEquals(
                    'cbf5a1f41db44412506cb6563a3218b50f45a710c7a8a65a3e9b18315bb338bf',
                    $query['sig']
                );
                return new Response(200);
            }
        ]);

        $middleware = SecureRequestMiddleware::create($this->config);
        $stack      = new HandlerStack($handler);
        $stack->push($middleware);
        $client = new Client(['handler' => $stack]);
        $client->get('https://api.instagram.com/v1/users/self', [
            'query' => [
                'access_token' => 'fb2e77d.47a0479900504cb3ab4a1f626d174d2d'
        ]]);
    }

    /**
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::create()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::__construct()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::__invoke()
     * @covers Instagram\Http\Middleware\AbstractMiddleware::__invoke()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::getParams()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::getPath()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::generateSig()
     */
    public function testGeneratesSigValueWithRequestParameters()
    {
        $handler = new MockHandler([
            function (RequestInterface $request) {
                $query = [];
                parse_str($request->getUri()->getQuery(), $query);

                $this->assertArrayHasKey('sig', $query);
                $this->assertEquals(
                    '260634b241a6cfef5e4644c205fb30246ff637591142781b86e2075faf1b163a',
                    $query['sig']
                );
                return new Response(200);
            }
        ]);

        $middleware = SecureRequestMiddleware::create($this->config);
        $stack      = new HandlerStack($handler);
        $stack->push($middleware);
        $client = new Client(['handler' => $stack]);
        $client->get('https://api.instagram.com/v1/media/657988443280050001_25025320', [
            'query' => [
                'access_token' => 'fb2e77d.47a0479900504cb3ab4a1f626d174d2d',
                'count'        => 10
            ]]);
    }

    /**
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::create()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::__construct()
     * @covers Instagram\Http\Middleware\SecureRequestMiddleware::__invoke()
     * @covers Instagram\Http\Middleware\AbstractMiddleware::__invoke()
     */
    public function testDoesNotAddSigValue()
    {
        $this->config->set('secure_requests', false);
        $handler = new MockHandler([
            function (RequestInterface $request) {
                $query = [];
                parse_str($request->getUri()->getQuery(), $query);

                $this->assertArrayNotHasKey('sig', $query);
                return new Response(200);
            }
        ]);

        $middleware = SecureRequestMiddleware::create($this->config);
        $stack      = new HandlerStack($handler);
        $stack->push($middleware);
        $client = new Client(['handler' => $stack]);
        $client->get('https://api.instagram.com/v1/media/657988443280050001_25025320', [
            'query' => [
                'access_token' => 'fb2e77d.47a0479900504cb3ab4a1f626d174d2d',
                'count'        => 10
            ]]);
    }
}
