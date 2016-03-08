<?php

namespace Instagram\Tests;

use \Mockery as m;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        m::close();
    }

    protected function getFixturesPath()
    {
        return realpath(__DIR__.'/fixtures/').'/';
    }

    protected function getFixture($filename, $decode = true)
    {
        $file = file_get_contents($this->getFixturesPath().$filename);

        return $decode
            ? json_decode($file, true)
            : $file;
    }
}
