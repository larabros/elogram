<?php

namespace Instagram\Tests\Http;

use Instagram\Exceptions\CsrfException;
use Instagram\Helpers\SessionLoginHelper;
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

        $this->helper = new SessionLoginHelper($provider);
    }

    /**
     * @covers Instagram\Helpers\SessionLoginHelper::__construct()
     * @runInSeparateProcess
     */
    public function testSessionIsNotRestarted()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers Instagram\Helpers\SessionLoginHelper::getLoginUrl()
     * @covers Instagram\Helpers\SessionLoginHelper::setCsrf()
     * @runInSeparateProcess
     */
    public function testGetLoginUrl()
    {
        $this->assertEquals('http://localhost:9000' ,$this->helper->getLoginUrl());
        $this->assertEquals('0000', $_SESSION['oauth2state']);
    }

    /**
     * @covers Instagram\Helpers\SessionLoginHelper::getAccessToken()
     * @covers Instagram\Helpers\SessionLoginHelper::validateCsrf()
     * @runInSeparateProcess
     */
    public function testGetAccessToken()
    {
        $this->helper->getLoginUrl();
        $_GET['state'] = "0000";
        $this->assertEquals('somenumbers', $this->helper->getAccessToken('1234')->getToken());

    }

    /**
     * @covers Instagram\Helpers\SessionLoginHelper::getAccessToken()
     * @covers Instagram\Helpers\SessionLoginHelper::validateCsrf()
     * @expectedException CsrfException
     * @runInSeparateProcess
     */
    public function testGetAccessTokenWithInvalidCsrf()
    {
        $this->helper->getAccessToken('1234')->getToken();

    }
}
