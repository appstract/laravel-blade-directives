<?php

namespace Appstract\BladeDirectives\Test;

use Artisan;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Appstract\BladeDirectives\Test\Concerns\CreatesApplication;

class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->blade = app('blade.compiler');
    }
}
