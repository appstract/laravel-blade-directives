<?php

namespace Appstract\BladeDirectives\Test;

class InlineTest extends TestCase
{
    public function test_window_is_compiled()
    {
        $blade = '@window("test", ["foo" => $bar])';

        $expected = implode("\n", [
            '<script>',
            'window.test = <?php echo is_array(["foo" => $bar]) ? json_encode(["foo" => $bar]) : ["foo" => $bar]; ?>;',
            '</script>',
        ]);

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_inline_js_is_compiled()
    {
        $blade = "@inline('/js/app.js')";

        $expected = implode("\n", [
            '<script>',
            "/* '/js/app.js' */",
            "<?php include public_path('/js/app.js') ?>",
            '</script>',
        ]);

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_inline_css_is_compiled()
    {
        $blade = "@inline('/css/app.css')";

        $expected = implode("\n", [
            '<style>',
            "/* '/css/app.css' */",
            "<?php include public_path('/css/app.css') ?>",
            '</style>',
        ]);

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_inline_html_is_compiled()
    {
        $blade = "@inline('/views/head.html')";

        $expected = implode("\n", [
            "/* '/views/head.html' */",
            "<?php include public_path('/views/head.html') ?>\n",
        ]);

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
