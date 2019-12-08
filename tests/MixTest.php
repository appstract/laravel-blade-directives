<?php

namespace Appstract\BladeDirectives\Test;

class MixTest extends TestCase
{
    public function test_mix_css_is_compiled()
    {
        $blade = "@mix('/css/app.css')";
        $expected = '<link rel="stylesheet" href="<?php echo mix(\'/css/app.css\') ?>">';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_mix_js_is_compiled()
    {
        $blade = "@mix('/css/app.js')";
        $expected = '<script src="<?php echo mix(\'/css/app.js\') ?>"></script>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_style_is_compiled()
    {
        $blade = '@style body { background: black } @endstyle';
        $expected = '<style> body { background: black } </style>';

        $this->assertSame($expected, $this->blade->compileString($blade));

        $blade = "@style('/css/app.css')";
        $expected = '<link rel="stylesheet" href="/css/app.css">';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_script_is_compiled()
    {
        $blade = "@script alert('hello world') @endscript";
        $expected = "<script> alert('hello world') </script>";

        $this->assertSame($expected, $this->blade->compileString($blade));

        $blade = "@script('/js/app.js')";
        $expected = '<script src="/js/app.js"></script>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
