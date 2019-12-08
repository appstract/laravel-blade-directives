<?php

namespace Appstract\BladeDirectives\Test;

class TypeofTest extends TestCase
{
    public function test_instanceof_is_compiled()
    {
        $blade = '@instanceof($instance, string) It is a string instance @endinstanceof';
        $expected = '<?php if ($instance instanceof string) : ?> It is a string instance <?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_typeof_is_compiled()
    {
        $blade = '@typeof($text, "string") Text is a string @endtypeof';
        $expected = '<?php if (gettype($text) == "string") : ?> Text is a string <?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
