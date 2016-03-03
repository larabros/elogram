<?php

namespace Instagram\Tests\Http;

use Instagram\Container\Builder;
use Instagram\Providers\EntityServiceProvider;
use Instagram\Providers\HttpServiceProvider;
use Instagram\Tests\TestCase;
use League\Container\ContainerInterface;
use Mockery as m;

class BuilderTest extends TestCase
{
    protected $builder;

    protected function setUp()
    {
        $this->builder = new Builder([
            'client_id' => 'CID',
            'client_secret' => 'CS',
            'access_token' => null,
        ]);
    }

    /**
     * @covers Instagram\Container\Builder::__construct()
     * @covers Instagram\Container\Builder::createContainer()
     * @covers Instagram\Container\Builder::createConfig()
     */
    public function testGetContainerAfterInstantiation()
    {
        $this->assertInstanceOf(ContainerInterface::class, $this->builder->getContainer());
    }

    /**
     * @covers Instagram\Container\Builder::__construct()
     * @covers Instagram\Container\Builder::createContainer()
     * @covers Instagram\Container\Builder::createConfig()
     * @covers Instagram\Container\Builder::register()
     */
    public function testRegisterProvider()
    {
        $providerMock = m::mock(HttpServiceProvider::class);
        $providerMock->shouldReceive('setContainer', 'provides', 'register')
            ->zeroOrMoreTimes()
            ->passthru();

        $container = $this->builder->register($providerMock)->getContainer();

        $this->assertTrue($container->has('provider'));
        $this->assertTrue($container->has('helper'));
        $this->assertTrue($container->has('http'));
    }

    /**
     * @covers Instagram\Container\Builder::__construct()
     * @covers Instagram\Container\Builder::createContainer()
     * @covers Instagram\Container\Builder::createConfig()
     * @covers Instagram\Container\Builder::register()
     */
    public function testRegisterProviders()
    {
        $providerMock1 = m::mock(HttpServiceProvider::class);
        $providerMock1->shouldReceive('setContainer', 'provides', 'register')
            ->zeroOrMoreTimes()
            ->passthru();

        $providerMock2 = m::mock(EntityServiceProvider::class);
        $providerMock2->shouldReceive('setContainer', 'provides', 'register')
            ->zeroOrMoreTimes()
            ->passthru();

        $container = $this->builder
            ->register([$providerMock1, $providerMock2])
            ->getContainer();

        $this->assertTrue($container->has('provider'));
        $this->assertTrue($container->has('helper'));
        $this->assertTrue($container->has('http'));

        $this->assertTrue($container->has('entity.user'));
        $this->assertTrue($container->has('entity.media'));
        $this->assertTrue($container->has('entity.comment'));
        $this->assertTrue($container->has('entity.like'));
        $this->assertTrue($container->has('entity.tag'));
    }
}
