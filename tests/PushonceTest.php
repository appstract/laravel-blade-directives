<?php

namespace Appstract\BladeDirectives\Test;

class PushonceTest extends TestCase
{
    public function _test_pushonce_is_compiled()
    {
        $blade = implode("\n", [
            "@pushonce('js:foobar')",
            '<script src="/js/foobar.js"></script>',
            '@endpushonce',
            "@pushonce('js:foobar')",
            '<script src="/js/foobar.js"></script>',
            "@endpushonce",
            "@stack('js')",
        ]);

        $expected = '<script src="/js/foobar.js"></script>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
