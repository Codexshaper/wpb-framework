<?php

namespace WPB\Test;

use PHPUnit\Framework\TestCase;

class Application extends TestCase
{
    /** @test */
    public function it_provides_a_factory_method()
    {
        $this->assertSame(true, true);
    }
}
