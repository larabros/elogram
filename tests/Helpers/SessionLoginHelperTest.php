<?php

namespace Instagram\Tests\Http;

use Instagram\Exceptions\CsrfException;
use Instagram\Helpers\SessionLoginHelper;
use Instagram\Http\Sessions\NativeSessionStore;
use Instagram\Tests\TestCase;
use League\OAuth2\Client\Provider\Instagram;
use League\OAuth2\Client\Token\AccessToken;
use \Mockery as m;


class SessionLoginHelperTest extends TestCase
{
    protected $helper;

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
            ->andReturn('http://localhost:9000');
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

        $this->helper = new SessionLoginHelper($provider, $store);
    }

    /**
     * @covers Instagram\Helpers\SessionLoginHelper::__construct()
     * @covers Instagram\Helpers\SessionLoginHelper::getLoginUrl()
     */
    public function testGetLoginUrl()
    {
        $this->assertEquals('http://localhost:9000', $this->helper->getLoginUrl());
    }

    /**
     * @covers Instagram\Helpers\SessionLoginHelper::__construct()
     * @covers Instagram\Helpers\SessionLoginHelper::getAccessToken()
     * @covers Instagram\Helpers\SessionLoginHelper::validateCsrf()
     * @covers Instagram\Helpers\SessionLoginHelper::getInput()
     */
    public function testGetAccessToken()
    {
        $this->helper->getLoginUrl();
        $_GET['state'] = "0000";
        $this->assertEquals('somenumbers', $this->helper->getAccessToken('1234')->getToken());
        unset($_GET['state']);
    }

    /**
     * @covers Instagram\Helpers\SessionLoginHelper::__construct()
     * @covers Instagram\Helpers\SessionLoginHelper::getAccessToken()
     * @covers Instagram\Helpers\SessionLoginHelper::validateCsrf()
     * @covers Instagram\Helpers\SessionLoginHelper::getInput()
     */
    public function testGetAccessTokenWithInvalidCsrf()
    {
        $this->setExpectedException(CsrfException::class);
        $this->helper->getAccessToken('1234')->getToken();

    }
}
