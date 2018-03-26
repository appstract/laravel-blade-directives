<?php

namespace Appstract\BladeDirectives\Test;

class DirectivesTest extends TestCase
{
    function test_istrue()
    {
        $blade = '@istrue($variable, "It is true")';
        $this->assertBladeRenders('It is true', $blade, ['variable' => true]);
        $this->assertBladeRenders('', $blade, ['variable' => false]);

        $this->assertBladeRenders(
            'This will be echoed',
            '@istrue($variable) This will be echoed @endistrue',
            ['variable' => true]
        );
    }

    function test_isfalse()
    {
        $blade = '@isfalse($variable, "It is false")';
        $this->assertBladeRenders('It is false', $blade, ['variable' => false]);
        $this->assertBladeRenders('', $blade, ['variable' => true]);

        $this->assertBladeRenders(
            'This will be echoed',
            '@isfalse($variable) This will be echoed @endistrue',
            ['variable' => false]
        );
    }

    function test_is_null()
    {
        $blade = '@isnull($variable) It is null @endisnull';
        $this->assertBladeRenders('It is null', $blade, ['variable' => null]);
    }

    function test_is_not_null()
    {
        $blade = '@isnotnull($variable) It is not null @endisnotnull';
        $this->assertBladeRenders('It is not null', $blade, ['variable' => 'not null']);
    }

    function test_mix()
    {
        // See /tests/laravel/public/mix-manifest.json for CSS file name
        $this->assertBladeRenders(
            '<link rel="stylesheet" href="/css/app.15be56e2d155778fd351.css">',
            "@mix('/css/app.css')"
        );
    }

    function test_style()
    {
        $this->assertBladeRenders(
            '<style> body { background: black } </style>',
            '@style body { background: black } @endstyle'
        );
        $this->assertBladeRenders(
            '<link rel="stylesheet" href="/css/app.css">',
            "@style('/css/app.css')"
        );
    }

    function test_script()
    {
        $this->assertBladeRenders(
            "<script> alert('hello world') </script>",
            "@script alert('hello world') @endscript"
        );
        $this->assertBladeRenders(
            '<script src="/js/app.js"></script>',
            "@script('/js/app.js')"
        );
    }

    function test_inline()
    {
        // see /tests/laravel/public/js/manifest-stub.js
        $this->assertBladeRenders(implode("\n", [
            '<script>',
            "//  '/js/manifest-stub.js'",
            "// manifest stub",
            '</script>'
        ]), "@inline('/js/manifest-stub.js')");
    }

    function test_pushonce()
    {
        // Push content twice and assert it is rendered only once
        $this->assertBladeRenders(
            '<script src="http://localhost/js/foobar.js"></script>',
            "
                @pushonce('js:foobar')
                    <script src=\"{{ asset('/js/foobar.js') }}\"></script>
                @endpushonce
                @pushonce('js:foobar')
                    <script src=\"{{ asset('/js/foobar.js') }}\"></script>
                @endpushonce
                @stack('js')
            "
        );
    }

    function test_routeis()
    {
        $this->withoutExceptionHandling();

        $this->get(route('webshop.checkout'))
            ->assertSee('Do something only on the checkout');
    }

    function test_routeisnot()
    {
        $this->withoutExceptionHandling();

        $this->get('not-checkout')
            ->assertSee('Do something only if this is not the checkout');
    }

    function test_instanceof()
    {
        $blade = '@instanceof($instance, DateTime) It is a DateTime instance @endinstanceof';

        $phpBlock = '@php $instance = new DateTime; @endphp';
        $this->assertBladeRenders('It is a DateTime instance', $phpBlock.$blade);

        $this->assertBladeRenders('', $blade, ['instance' => 'string']);
    }

    function test_typeof()
    {
        $blade = "@typeof(\$text, 'string') Text is a string @endtypeof";
        $this->assertBladeRenders('Text is a string', $blade, ['text' => 'I am a string']);
        $this->assertBladeRenders('', $blade, ['text' => 42]);
    }

    function test_repeat()
    {
        $this->assertBladeRenders(
            'Iteration #0  Iteration #1  Iteration #2',
            '@repeat(3) Iteration #{{ $iteration }} @endrepeat'
        );
    }

    function test_fa()
    {
        $this->assertBladeRenders(
            '<i class="fa fa-address-book optional-extra-class"></i>',
            "@fa('address-book', 'optional-extra-class')"
        );
    }

    function test_data()
    {
        $this->assertBladeRenders(
            'data-foo="123" data-bar="baz"',
            "@data(['foo' => 123, 'bar' => 'baz'])"
        );
    }
}
