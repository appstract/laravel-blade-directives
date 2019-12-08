<?php

namespace Appstract\BladeDirectives\Test;

class MixTest extends TestCase
{
    public function test_mix_css()
    {
        $blade = "@mix('/css/app.css')";

        $expected = '<link rel="stylesheet" href="<?php echo mix(\'/css/app.css\') ?>">';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_mix_js()
    {
        $blade = "@mix('/css/app.js')";

        $expected = '<script src="<?php echo mix(\'/css/app.js\') ?>"></script>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_style()
    {
        $blade = '@style body { background: black } @endstyle';

        $expected = '<style> body { background: black } </style>';

        $this->assertSame($expected, $this->blade->compileString($blade));

        $blade = "@style('/css/app.css')";

        $expected = '<link rel="stylesheet" href="/css/app.css">';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_script()
    {
        $blade = "@script alert('hello world') @endscript";

        $expected = "<script> alert('hello world') </script>";

        $this->assertSame($expected, $this->blade->compileString($blade));

        $blade = "@script('/js/app.js')";

        $expected = '<script src="/js/app.js"></script>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    // public function test_js_inline()
    // {
    //     // see /tests/laravel/public/js/manifest-stub.js
    //     $this->assertBlade(implode("\n", [
    //         '<script>',
    //         "/* '/js/manifest-stub.js' */",
    //         '// manifest stub',
    //         '</script>',
    //     ]), "@inline('/js/manifest-stub.js')");
    // }

    // public function test_css_inline()
    // {
    //     // see /tests/laravel/public/js/manifest-stub.js
    //     $this->assertBlade(implode("\n", [
    //         '<style>',
    //         "/* '/css/test.css' */",
    //         '/* for Test */',
    //         'body {}',
    //         '</style>',
    //     ]), "@inline('/css/test.css')");
    // }
}
