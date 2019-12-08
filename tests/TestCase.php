<?php

namespace Appstract\BladeDirectives\Test;

use Appstract\BladeDirectives\Test\Concerns\CreatesApplication;
use Orchestra\Testbench\TestCase as BaseTestCase;

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
