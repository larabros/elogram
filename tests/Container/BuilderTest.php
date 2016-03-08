<?php

namespace Larabros\Elogram\Tests\Http;

use Larabros\Elogram\Container\Builder;
use Larabros\Elogram\Helpers\RedirectLoginHelper;
use Larabros\Elogram\Http\Clients\AdapterInterface;
use Larabros\Elogram\Providers\EntityServiceProvider;
use Larabros\Elogram\Providers\CoreServiceProvider;
use Larabros\Elogram\Providers\GuzzleServiceProvider;
use Larabros\Elogram\Tests\TestCase;
use League\Container\ContainerInterface;
use Mockery as m;

class BuilderTest extends TestCase
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->builder = new Builder([
            'client_id' => 'CID',
            'client_secret' => 'CS',
            'access_token' => null,
        ], false);
    }

    /**
     * @covers Larabros\Elogram\Container\Builder::__construct()
     * @covers Larabros\Elogram\Container\Builder::createContainer()
     * @covers Larabros\Elogram\Container\Builder::createConfig()
     */
    public function testGetContainerAfterInstantiation()
    {
        $this->assertInstanceOf(ContainerInterface::class, $this->builder->getContainer());
    }

    /**
     * @covers Larabros\Elogram\Container\Builder::__construct()
     * @covers Larabros\Elogram\Container\Builder::createContainer()
     * @covers Larabros\Elogram\Container\Builder::createConfig()
     * @covers Larabros\Elogram\Container\Builder::registerProvider()
     */
    public function testRegisterProvider()
    {
        $providerMock = $this->createMockProvider(CoreServiceProvider::class);

        $container = $this->builder->registerProvider($providerMock)->getContainer();

        $this->assertTrue($container->has('provider'));
        $this->assertTrue($container->has(RedirectLoginHelper::class));
    }

    /**
     * @covers Larabros\Elogram\Container\Builder::__construct()
     * @covers Larabros\Elogram\Container\Builder::createContainer()
     * @covers Larabros\Elogram\Container\Builder::createConfig()
     * @covers Larabros\Elogram\Container\Builder::registerProviders()
     * @covers Larabros\Elogram\Container\Builder::registerProvider()
     */
    public function testRegisterProviders()
    {
        $providerMock1 = $this->createMockProvider(CoreServiceProvider::class);
        $providerMock2 = $this->createMockProvider(GuzzleServiceProvider::class);
        $providerMock3 = $this->createMockProvider(EntityServiceProvider::class);

        $container = $this->builder
            ->registerProviders([$providerMock1, $providerMock2, $providerMock3])
            ->getContainer();

        $this->assertTrue($container->has(RedirectLoginHelper::class));
        $this->assertTrue($container->has('provider'));
        $this->assertTrue($container->has(AdapterInterface::class));

        $this->assertTrue($container->has('entity.user'));
        $this->assertTrue($container->has('entity.media'));
        $this->assertTrue($container->has('entity.comment'));
        $this->assertTrue($container->has('entity.like'));
        $this->assertTrue($container->has('entity.tag'));
    }

    /**
     * @covers Larabros\Elogram\Container\Builder::__construct()
     * @covers Larabros\Elogram\Container\Builder::createContainer()
     * @covers Larabros\Elogram\Container\Builder::createConfig()
     * @covers Larabros\Elogram\Container\Builder::registerProviders()
     * @covers Larabros\Elogram\Container\Builder::registerProvider()
     */
    public function testRegisterNoProviders()
    {
        $container = $this->builder
            ->registerProviders()
            ->getContainer();

        $this->assertFalse($container->has(RedirectLoginHelper::class));
        $this->assertFalse($container->has('provider'));
        $this->assertFalse($container->has(AdapterInterface::class));

        $this->assertFalse($container->has('entity.user'));
        $this->assertFalse($container->has('entity.media'));
        $this->assertFalse($container->has('entity.comment'));
        $this->assertFalse($container->has('entity.like'));
        $this->assertFalse($container->has('entity.tag'));
    }

    /**
     * @covers Larabros\Elogram\Container\Builder::__construct()
     * @covers Larabros\Elogram\Container\Builder::createContainer()
     * @covers Larabros\Elogram\Container\Builder::createConfig()
     * @covers Larabros\Elogram\Container\Builder::registerProviders()
     * @covers Larabros\Elogram\Container\Builder::registerProvider()
     */
    public function testRegisterDefaultProviders()
    {
        $container = (new Builder([
            'client_id' => 'CID',
            'client_secret' => 'CS',
            'access_token' => null,
        ]))->getContainer();

        $this->assertTrue($container->has(RedirectLoginHelper::class));
        $this->assertTrue($container->has('provider'));
        $this->assertTrue($container->has(AdapterInterface::class));

        $this->assertTrue($container->has('entity.user'));
        $this->assertTrue($container->has('entity.media'));
        $this->assertTrue($container->has('entity.comment'));
        $this->assertTrue($container->has('entity.like'));
        $this->assertTrue($container->has('entity.tag'));
    }

    private function createMockProvider($provider)
    {
        $mock = m::mock($provider);
        $mock->shouldReceive('setContainer', 'provides', 'register')
            ->zeroOrMoreTimes()
            ->passthru();
        return $mock;
    }
}
