<?php

namespace Instagram\Tests\Http;

use Instagram\Container\Builder;
use Instagram\Helpers\RedirectLoginHelper;
use Instagram\Http\Clients\AdapterInterface;
use Instagram\Providers\EntityServiceProvider;
use Instagram\Providers\CoreServiceProvider;
use Instagram\Providers\GuzzleServiceProvider;
use Instagram\Tests\TestCase;
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
     * @covers Instagram\Container\Builder::registerProvider()
     */
    public function testRegisterProvider()
    {
        $providerMock = $this->createMockProvider(CoreServiceProvider::class);

        $container = $this->builder->registerProvider($providerMock)->getContainer();

        $this->assertTrue($container->has('provider'));
        $this->assertTrue($container->has(RedirectLoginHelper::class));
    }

    /**
     * @covers Instagram\Container\Builder::__construct()
     * @covers Instagram\Container\Builder::createContainer()
     * @covers Instagram\Container\Builder::createConfig()
     * @covers Instagram\Container\Builder::registerProviders()
     * @covers Instagram\Container\Builder::registerProvider()
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
     * @covers Instagram\Container\Builder::__construct()
     * @covers Instagram\Container\Builder::createContainer()
     * @covers Instagram\Container\Builder::createConfig()
     * @covers Instagram\Container\Builder::registerProviders()
     * @covers Instagram\Container\Builder::registerProvider()
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
     * @covers Instagram\Container\Builder::__construct()
     * @covers Instagram\Container\Builder::createContainer()
     * @covers Instagram\Container\Builder::createConfig()
     * @covers Instagram\Container\Builder::registerProviders()
     * @covers Instagram\Container\Builder::registerProvider()
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
