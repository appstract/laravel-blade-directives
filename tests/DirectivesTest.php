<?php

namespace Appstract\BladeDirectives\Test;

class DirectivesTest extends TestCase
{
    public function test_istrue()
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

    public function test_isfalse()
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

    public function test_is_null()
    {
        $blade = '@isnull($variable) It is null @endisnull';
        $this->assertBladeRenders('It is null', $blade, ['variable' => null]);
    }

    public function test_is_not_null()
    {
        $blade = '@isnotnull($variable) It is not null @endisnotnull';
        $this->assertBladeRenders('It is not null', $blade, ['variable' => 'not null']);
    }

    public function test_mix()
    {
        // See /tests/laravel/public/mix-manifest.json for CSS file name
        $this->assertBladeRenders(
            '<link rel="stylesheet" href="/css/app.15be56e2d155778fd351.css">',
            "@mix('/css/app.css')"
        );
    }

    public function test_style()
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

    public function test_script()
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

    public function test_inline()
    {
        // see /tests/laravel/public/js/manifest-stub.js
        $this->assertBladeRenders(implode("\n", [
            '<script>',
            "//  '/js/manifest-stub.js'",
            '// manifest stub',
            '</script>',
        ]), "@inline('/js/manifest-stub.js')");
    }

    public function test_pushonce()
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

    public function test_routeis()
    {
        $this->withoutExceptionHandling();

        $this->get(route('webshop.checkout'))
            ->assertSee('Do something only on the checkout');
    }

    public function test_routeisnot()
    {
        $this->withoutExceptionHandling();

        $this->get('not-checkout')
            ->assertSee('Do something only if this is not the checkout');
    }

    public function test_instanceof()
    {
        $blade = '@instanceof($instance, DateTime) It is a DateTime instance @endinstanceof';

        $phpBlock = '@php $instance = new DateTime; @endphp';
        $this->assertBladeRenders('It is a DateTime instance', $phpBlock.$blade);

        $this->assertBladeRenders('', $blade, ['instance' => 'string']);
    }

    public function test_typeof()
    {
        $blade = "@typeof(\$text, 'string') Text is a string @endtypeof";
        $this->assertBladeRenders('Text is a string', $blade, ['text' => 'I am a string']);
        $this->assertBladeRenders('', $blade, ['text' => 42]);
    }

    public function test_repeat()
    {
        $this->assertBladeRenders(
            'Iteration #0  Iteration #1  Iteration #2',
            '@repeat(3) Iteration #{{ $iteration }} @endrepeat'
        );
    }

    public function test_fa()
    {
        $this->assertBladeRenders(
            '<i class="fa fa-address-book optional-extra-class"></i>',
            "@fa('address-book', 'optional-extra-class')"
        );
    }

    public function test_fas()
    {
        $this->assertBladeRenders(
            '<i class="fas fa-address-book optional-extra-class"></i>',
            "@fas('address-book', 'optional-extra-class')"
        );
    }

    public function test_far()
    {
        $this->assertBladeRenders(
            '<i class="far fa-address-book optional-extra-class"></i>',
            "@far('address-book', 'optional-extra-class')"
        );
    }

    public function test_fal()
    {
        $this->assertBladeRenders(
            '<i class="fal fa-address-book optional-extra-class"></i>',
            "@fal('address-book', 'optional-extra-class')"
        );
    }

    public function test_fab()
    {
        $this->assertBladeRenders(
            '<i class="fab fa-address-book optional-extra-class"></i>',
            "@fab('address-book', 'optional-extra-class')"
        );
    }

    public function test_mdi()
    {
        $this->assertBladeRenders(
            '<i class="mdi mdi-account optional-extra-class"></i>',
            "@mdi('account', 'optional-extra-class')"
        );
    }

    public function test_glyphicons()
    {
        $this->assertBladeRenders(
            '<i class="glyphicons glyphicons-glass optional-extra-class"></i>',
            "@glyph('glass', 'optional-extra-class')"
        );
    }

    public function test_data()
    {
        $this->assertBladeRenders(
            'data-foo="123" data-bar="baz"',
            "@data(['foo' => 123, 'bar' => 'baz'])"
        );
    }

    public function test_has_error()
    {
        //without errors var
        $this->assertBladeRenders(
            'Input: Has not errors',
            'Input:@haserror($errors->has(\'input_name\')) This input has an error @endhaserror Has not errors'
        );

        $errors = "new \Illuminate\Support\MessageBag(['input_name' => 1])";

        //with errors var
        $this->assertBladeRenders(
            'Input: This input has an error',
            'Input:@haserror("input_name") This input has an error @endhaserror',
            [
                'errors' => $errors,
            ]
        );
    }
}
