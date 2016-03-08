<?php

namespace Larabros\Elogram\Tests\Http\Sessions;

use Larabros\Elogram\Exceptions\Exception;
use Larabros\Elogram\Http\Sessions\NativeSessionStore;
use Larabros\Elogram\Tests\TestCase;

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
     * @covers Larabros\Elogram\Http\Sessions\NativeSessionStore::__construct()
     * @covers Larabros\Elogram\Http\Sessions\NativeSessionStore::get()
     * @runInSeparateProcess
     */
    public function testWhenSessionIsNotStarted()
    {
        session_write_close();
        $this->setExpectedException(Exception::class);
        $session = new NativeSessionStore();
    }

    /**
     * @covers Larabros\Elogram\Http\Sessions\NativeSessionStore::__construct()
     * @covers Larabros\Elogram\Http\Sessions\NativeSessionStore::get()
     */
    public function testGetNonexistentKey()
    {
        $this->assertNull($this->store->get('foo'));
    }

    /**
     * @covers Larabros\Elogram\Http\Sessions\NativeSessionStore::__construct()
     * @covers Larabros\Elogram\Http\Sessions\NativeSessionStore::set()
     * @covers Larabros\Elogram\Http\Sessions\NativeSessionStore::get()
     */
    public function testSetAndGet()
    {
        $this->store->set('foo', 'bar');
        $this->assertEquals('bar', $this->store->get('foo'));
        $this->assertEquals('bar', $_SESSION['IG_foo']);
    }
}
