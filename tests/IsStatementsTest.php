<?php

namespace Appstract\BladeDirectives\Test;

class IsStatementsTest extends TestCase
{
    public function test_istrue_is_compiled()
    {
        $blade = '@istrue ($v) foo @endistrue';
        $expected = '<?php if (isset($v) && (bool) $v === true) : ?> foo <?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));

        $blade = '@istrue ($v, "foo")';
        $expected = '<?php if (isset($v) && (bool) $v === true) : ?><?php echo "foo"; ?><?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_isfalse_is_compiled()
    {
        $blade = '@isfalse ($v) foo @endisfalse';
        $expected = '<?php if (isset($v) && (bool) $v === false) : ?> foo <?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));

        $blade = '@isfalse ($v, "foo")';
        $expected = '<?php if (isset($v) && (bool) $v === false) : ?><?php echo "foo"; ?><?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_isnull_is_compiled()
    {
        $blade = '@isnull ($v) foo @endisnull';
        $expected = '<?php if (is_null($v)) : ?> foo <?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_isnotnull_is_compiled()
    {
        $blade = '@isnotnull ($v) foo @endisnotnull';
        $expected = '<?php if (! is_null($v)) : ?> foo <?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
