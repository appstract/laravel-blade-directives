<?php

namespace Appstract\BladeDirectives\Test;

class IsStatementTest extends TestCase
{
    public function test_istrue()
    {
        $blade = '@istrue ($v) foo @endistrue';

        $expected = '<?php if (isset($v) && (bool) $v === true) : ?> foo <?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_isfalse()
    {
        $blade = '@isfalse ($v) foo @endisfalse';

        $expected = '<?php if (isset($v) && (bool) $v === false) : ?> foo <?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_isnull()
    {
        $blade = '@isnull ($v) foo @endisnull';

        $expected = '<?php if (is_null($v)) : ?> foo <?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_isnotnull()
    {
        $blade = '@isnotnull ($v) foo @endisnotnull';

        $expected = '<?php if (! is_null($v)) : ?> foo <?php endif; ?>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}