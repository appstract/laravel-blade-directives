<?php

namespace Appstract\BladeDirectives\Test;

use Appstract\BladeDirectives\Test\Concerns\CreatesApplication;
use Appstract\BladeDirectives\Test\Concerns\RendersBlade;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use CreatesApplication, RendersBlade;

    /**
     * Assert that blade markup and view data render HTML markup.
     *
     * @param string $expectedHtml
     * @param string $viewContent blade markup
     * @param array $viewData
     * @return void
     */
    protected function assertBladeRenders($expectedHtml, $viewContent, $viewData = [])
    {
        $this->assertEquals($expectedHtml, $this->renderBlade($viewContent, $viewData));
    }
}
