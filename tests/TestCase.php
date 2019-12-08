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
}
