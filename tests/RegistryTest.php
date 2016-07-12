<?php

use Zhibaihe\Event\Registry;

class RegistryTest extends PHPUnit_Framework_TestCase {

    /** @test */
    public function it_registers_and_fetches_registration()
    {
        $registry = new Registry;

        $registry->set('foo', 'bar');

        $this->assertEquals('bar', $registry->get('foo'));
    }

    /** @test */
    public function it_responds_to_inquiries_about_a_key()
    {
        $registry = new Registry;

        $registry->set('foo', 'bar');

        $this->assertTrue($registry->has('foo'));
        $this->assertFalse($registry->has('bar'));
    }

    /** @test */
    public function it_appends_values_to_a_key()
    {
        $registry = new Registry;

        $registry->set('foo', 'bar');
        $registry->append('foo', 'zoo');

        $this->assertEquals(['bar', 'zoo'], $registry->get('foo'));
    }

}

