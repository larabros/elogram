<?php

namespace Instagram\Tests\Http\Sessions;

use Instagram\Exceptions\Exception;
use Instagram\Http\Sessions\NativeSessionStore;
use Instagram\Tests\TestCase;

class NativeSessionStoreTest extends TestCase
{
    /**
     * @var NativeSessionStore
     */
    protected $store;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->store = new NativeSessionStore();
    }

    /**
     * @covers Instagram\Http\Sessions\NativeSessionStore::__construct()
     * @covers Instagram\Http\Sessions\NativeSessionStore::get()
     * @runInSeparateProcess
     */
    public function testWhenSessionIsNotStarted()
    {
        session_write_close();
        $this->setExpectedException(Exception::class);
        $session = new NativeSessionStore();
    }

    /**
     * @covers Instagram\Http\Sessions\NativeSessionStore::__construct()
     * @covers Instagram\Http\Sessions\NativeSessionStore::get()
     */
    public function testGetNonexistentKey()
    {
        $this->assertNull($this->store->get('foo'));
    }

    /**
     * @covers Instagram\Http\Sessions\NativeSessionStore::__construct()
     * @covers Instagram\Http\Sessions\NativeSessionStore::set()
     * @covers Instagram\Http\Sessions\NativeSessionStore::get()
     */
    public function testSetAndGet()
    {
        $this->store->set('foo', 'bar');
        $this->assertEquals('bar', $this->store->get('foo'));
        $this->assertEquals('bar', $_SESSION['IG_foo']);
    }
}
