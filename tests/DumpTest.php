<?php

namespace Appstract\BladeDirectives\Test;

class DumpTest extends TestCase
{
    public function test_dump_is_compiled()
    {
        $blade = '@dump($variable)';
        $expected = '<?php dump($variable); ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_dd_is_compiled()
    {
        $blade = '@dd($variable)';
        $expected = '<?php dd($variable); ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
