<?php

namespace Appstract\BladeDirectives\Test;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Appstract\BladeDirectives\Test\Concerns\CreatesApplication;

class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $blade;

    public function setUp(): void
    {
        parent::setUp();

        $this->blade = app('blade.compiler');
    }

    // https://stevegrunwell.com/blog/custom-laravel-blade-directives/
    protected function assertDirectiveOutput($expected, $expression, $variables = [], $message = '') {
        $compiled = $this->blade->compileString($expression);

        ob_start();
        extract($variables);
        eval(' ?>'.$compiled.'<?php ');

        $output = ob_get_clean();

        $this->assertSame($expected, $output, $message);
    }
}
