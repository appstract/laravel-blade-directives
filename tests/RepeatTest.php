<?php

namespace Appstract\BladeDirectives\Test;

class RepeatTest extends TestCase
{
    public function test_repeat_is_compiled()
    {
        $blade = '@repeat(3) Iteration #{{ $iteration }} @endrepeat';

        $expected = implode('', [
            '<?php for ($iteration = 0 ; $iteration < (int) 3; $iteration++): ?>',
            ' Iteration #<?php echo e($iteration); ?> ',
            '<?php endfor; ?>',
        ]);

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
