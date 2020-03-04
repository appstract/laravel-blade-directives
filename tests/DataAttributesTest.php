<?php

namespace Appstract\BladeDirectives\Test;

class DataAttributesTest extends TestCase
{
    public function _test_data_attributes_is_compiled()
    {
        $blade = "@dataAttributes(['foo' => 123, 'bar' => 'baz'])";

        $expected = implode("\n", [
            "<?php echo collect((array) ['foo' => 123, 'bar' => 'baz'])",
            '->map(function($value, $key) {',
            'return "data-{$key}=\"{$value}\"";',
            '})',
            '->implode(" "); ?>',
        ]);

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
