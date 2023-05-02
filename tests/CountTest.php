<?php

namespace Appstract\BladeDirectives\Test;

class CountTest extends TestCase
{
    public function test_count_is_compiled()
    {
        $blade = "@count([1,2,3])";
        $expected = "<?php echo 3; ?>";

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
