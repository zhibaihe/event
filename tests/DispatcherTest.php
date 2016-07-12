<?php

use Zhibaihe\Event\Dispatcher;

class DispatcherTest extends PHPUnit_Framework_TestCase {

    /** @test */
    public function it_collects_listeners_and_call_them_when_events_happen()
    {
        $dispatcher = new Dispatcher;

        $listener = $this->createMock('DummyListener', ['handle']);
        $listener->expects($this->once())
            ->method('handle');

        $dispatcher->listen('foo', [$listener, 'handle']);

        $dispatcher->dispatch('foo');
    }

    /** @test */
    public function it_passes_parameters_to_callbacks()
    {
        $dispatcher = new Dispatcher;

        $listener = $this->createMock('DummyListener', ['handle']);
        $listener->expects($this->once())
            ->method('handle')
            ->with('bar', 'zoo');

        $dispatcher->listen('foo', [$listener, 'handle']);

        $dispatcher->dispatch('foo', ['bar', 'zoo']);
    }

    /** @test */
    public function it_converts_single_parameter_to_array()
    {
        $dispatcher = new Dispatcher;

        $listener = $this->createMock('DummyListener', ['handle']);
        $listener->expects($this->once())
            ->method('handle')
            ->with('bar');

        $dispatcher->listen('foo', [$listener, 'handle']);

        $dispatcher->dispatch('foo', 'bar');
    }
}

class DummyListener{
    public function handle()
    {

    }
}
