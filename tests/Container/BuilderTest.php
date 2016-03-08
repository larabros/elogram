<?php

namespace Elogram\Tests\Http;

use Elogram\Container\Builder;
use Elogram\Helpers\RedirectLoginHelper;
use Elogram\Http\Clients\AdapterInterface;
use Elogram\Providers\EntityServiceProvider;
use Elogram\Providers\CoreServiceProvider;
use Elogram\Providers\GuzzleServiceProvider;
use Elogram\Tests\TestCase;
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
     * @covers Elogram\Container\Builder::__construct()
     * @covers Elogram\Container\Builder::createContainer()
     * @covers Elogram\Container\Builder::createConfig()
     */
    public function testGetContainerAfterInstantiation()
    {
        $this->assertInstanceOf(ContainerInterface::class, $this->builder->getContainer());
    }

    /**
     * @covers Elogram\Container\Builder::__construct()
     * @covers Elogram\Container\Builder::createContainer()
     * @covers Elogram\Container\Builder::createConfig()
     * @covers Elogram\Container\Builder::registerProvider()
     */
    public function testRegisterProvider()
    {
        $providerMock = $this->createMockProvider(CoreServiceProvider::class);

        $container = $this->builder->registerProvider($providerMock)->getContainer();

        $this->assertTrue($container->has('provider'));
        $this->assertTrue($container->has(RedirectLoginHelper::class));
    }

    /**
     * @covers Elogram\Container\Builder::__construct()
     * @covers Elogram\Container\Builder::createContainer()
     * @covers Elogram\Container\Builder::createConfig()
     * @covers Elogram\Container\Builder::registerProviders()
     * @covers Elogram\Container\Builder::registerProvider()
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
     * @covers Elogram\Container\Builder::__construct()
     * @covers Elogram\Container\Builder::createContainer()
     * @covers Elogram\Container\Builder::createConfig()
     * @covers Elogram\Container\Builder::registerProviders()
     * @covers Elogram\Container\Builder::registerProvider()
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
     * @covers Elogram\Container\Builder::__construct()
     * @covers Elogram\Container\Builder::createContainer()
     * @covers Elogram\Container\Builder::createConfig()
     * @covers Elogram\Container\Builder::registerProviders()
     * @covers Elogram\Container\Builder::registerProvider()
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
