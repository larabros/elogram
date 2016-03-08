<?php

namespace Larabros\Elogram\Tests\Http;

use Larabros\Elogram\Exceptions\CsrfException;
use Larabros\Elogram\Helpers\RedirectLoginHelper;
use Larabros\Elogram\Http\Sessions\NativeSessionStore;
use Larabros\Elogram\Tests\TestCase;
use League\OAuth2\Client\Provider\Instagram;
use League\OAuth2\Client\Token\AccessToken;
use \Mockery as m;

class RedirectLoginHelperTest extends TestCase
{
    /**
     * @var RedirectLoginHelper
     */
    protected $helper;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $token    = m::mock(AccessToken::class, [['access_token' => "somenumbers"]]);
        $provider = m::mock(Instagram::class);
        $store    = m::mock(NativeSessionStore::class);

        $token->shouldReceive('getToken')
            ->zeroOrMoreTimes()
            ->andReturn('somenumbers');

        $provider->shouldReceive('getAuthorizationUrl')
            ->zeroOrMoreTimes()
            ->andReturn('https://api.instagram.com/oauth/authorize?redirect_url=http://localhost:9000');
        $provider->shouldReceive('getAccessToken')
            ->zeroOrMoreTimes()
            ->andReturn($token);
        $provider->shouldReceive('getState')
            ->zeroOrMoreTimes()
            ->andReturn('0000');

        $store->shouldReceive('set')
            ->withAnyArgs()
            ->zeroOrMoreTimes()
            ->andReturnNull();

        $store->shouldReceive('get')
            ->with('oauth2state')
            ->zeroOrMoreTimes()
            ->andReturn('0000');

        $this->helper = new RedirectLoginHelper($provider, $store);
    }

    /**
     * @covers Larabros\Elogram\Helpers\RedirectLoginHelper::__construct()
     * @covers Larabros\Elogram\Helpers\RedirectLoginHelper::getLoginUrl()
     */
    public function testGetLoginUrl()
    {
        $expected = 'https://api.instagram.com/oauth/authorize?';
        $actual   = $this->helper->getLoginUrl();
        $this->assertStringStartsWith($expected, $actual);
    }

    /**
     * @covers Larabros\Elogram\Helpers\RedirectLoginHelper::__construct()
     * @covers Larabros\Elogram\Helpers\RedirectLoginHelper::getAccessToken()
     * @covers Larabros\Elogram\Helpers\RedirectLoginHelper::validateCsrf()
     * @covers Larabros\Elogram\Helpers\RedirectLoginHelper::getInput()
     */
    public function testGetAccessToken()
    {
        $this->helper->getLoginUrl();
        $_GET['state'] = "0000";
        $this->assertEquals('somenumbers', $this->helper->getAccessToken('1234')->getToken());
        unset($_GET['state']);
    }

    /**
     * @covers Larabros\Elogram\Helpers\RedirectLoginHelper::__construct()
     * @covers Larabros\Elogram\Helpers\RedirectLoginHelper::getAccessToken()
     * @covers Larabros\Elogram\Helpers\RedirectLoginHelper::validateCsrf()
     * @covers Larabros\Elogram\Helpers\RedirectLoginHelper::getInput()
     */
    public function testGetAccessTokenWithInvalidCsrf()
    {
        $this->setExpectedException(CsrfException::class);
        $this->helper->getAccessToken('1234')->getToken();

    }
}
