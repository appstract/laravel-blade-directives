<?php

namespace Appstract\BladeDirectives\Test;

class HelpersTest extends TestCase
{
    public function test_snake_is_compiled()
    {
        $blade = "@snake('fooBar')";
        $expected = "<?php echo 'foo_bar'; ?>";

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_camel_is_compiled()
    {
        $blade = "@camel('foo bar')";
        $expected = "<?php echo 'fooBar'; ?>";

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_kebab_is_compiled()
    {
        $blade = "@kebab('foo bar')";
        $expected = "<?php echo 'foo-bar'; ?>";

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
