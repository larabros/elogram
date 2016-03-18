<?php

namespace Larabros\Elogram\Tests\Http;

use Larabros\Elogram\Container\Builder;
use Larabros\Elogram\Helpers\RedirectLoginHelper;
use Larabros\Elogram\Http\Clients\AdapterInterface;
use Larabros\Elogram\Http\OAuth2\Providers\AdapterInterface as ProviderInterface;
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
        ]);
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

        $this->assertTrue($container->has(ProviderInterface::class));
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
        $this->assertTrue($container->has(ProviderInterface::class));
        $this->assertTrue($container->has(AdapterInterface::class));

        $this->assertTrue($container->has('repo.user'));
        $this->assertTrue($container->has('repo.media'));
        $this->assertTrue($container->has('repo.comment'));
        $this->assertTrue($container->has('repo.like'));
        $this->assertTrue($container->has('repo.tag'));
    }

    /**
     * @covers Larabros\Elogram\Container\Builder::__construct()
     * @covers Larabros\Elogram\Container\Builder::createContainer()
     * @covers Larabros\Elogram\Container\Builder::createConfig()
     * @covers Larabros\Elogram\Container\Builder::registerProviders()
     * @covers Larabros\Elogram\Container\Builder::registerProvider()
     */
    public function testRegisterProvidersThroughConstructor()
    {
        $providerMock1 = $this->createMockProvider(CoreServiceProvider::class);
        $providerMock2 = $this->createMockProvider(GuzzleServiceProvider::class);
        $providerMock3 = $this->createMockProvider(EntityServiceProvider::class);

        $container = (new Builder([
            'client_id' => 'CID',
            'client_secret' => 'CS',
            'access_token' => null,
            'providers' => [$providerMock1, $providerMock2, $providerMock3],
        ]))->getContainer();
        
        $this->assertTrue($container->has(RedirectLoginHelper::class));
        $this->assertTrue($container->has(ProviderInterface::class));
        $this->assertTrue($container->has(AdapterInterface::class));

        $this->assertTrue($container->has('repo.user'));
        $this->assertTrue($container->has('repo.media'));
        $this->assertTrue($container->has('repo.comment'));
        $this->assertTrue($container->has('repo.like'));
        $this->assertTrue($container->has('repo.tag'));
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
        $this->assertTrue($container->has(ProviderInterface::class));
        $this->assertTrue($container->has(AdapterInterface::class));

        $this->assertTrue($container->has('repo.user'));
        $this->assertTrue($container->has('repo.media'));
        $this->assertTrue($container->has('repo.comment'));
        $this->assertTrue($container->has('repo.like'));
        $this->assertTrue($container->has('repo.tag'));
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
