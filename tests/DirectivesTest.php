<?php

namespace Appstract\BladeDirectives\Test;

class DirectivesTest extends TestCase
{
    // public function test_pushonce()
    // {
    //     // Push content twice and assert it is rendered only once
    //     $this->assertBlade(
    //         '<script src="http://localhost/js/foobar.js"></script>',
    //         "
    //             @pushonce('js:foobar')
    //                 <script src=\"{{ asset('/js/foobar.js') }}\"></script>
    //             @endpushonce
    //             @pushonce('js:foobar')
    //                 <script src=\"{{ asset('/js/foobar.js') }}\"></script>
    //             @endpushonce
    //             @stack('js')
    //         "
    //     );
    // }

    // public function test_routeis()
    // {
    //     $this->withoutExceptionHandling();

    //     $this->get(route('webshop.checkout'))
    //         ->assertSee('Do something only on the checkout');
    // }

    // public function test_routeisnot()
    // {
    //     $this->withoutExceptionHandling();

    //     $this->get('not-checkout')
    //         ->assertSee('Do something only if this is not the checkout');
    // }

    // public function test_instanceof()
    // {
    //     $blade = '@instanceof($instance, DateTime) It is a DateTime instance @endinstanceof';

    //     $phpBlock = '@php $instance = new DateTime; @endphp';
    //     $this->assertBlade('It is a DateTime instance', $phpBlock.$blade);

    //     $this->assertBlade('', $blade, ['instance' => 'string']);
    // }

    // public function test_typeof()
    // {
    //     $blade = "@typeof(\$text, 'string') Text is a string @endtypeof";
    //     $this->assertBlade('Text is a string', $blade, ['text' => 'I am a string']);
    //     $this->assertBlade('', $blade, ['text' => 42]);
    // }

    // public function test_repeat()
    // {
    //     $this->assertBlade(
    //         'Iteration #0  Iteration #1  Iteration #2',
    //         '@repeat(3) Iteration #{{ $iteration }} @endrepeat'
    //     );
    // }

    // public function test_fa()
    // {
    //     $this->assertBlade(
    //         '<i class="fa fa-address-book optional-extra-class"></i>',
    //         "@fa('address-book', 'optional-extra-class')"
    //     );
    // }

    // public function test_fas()
    // {
    //     $this->assertBlade(
    //         '<i class="fas fa-address-book optional-extra-class"></i>',
    //         "@fas('address-book', 'optional-extra-class')"
    //     );
    // }

    // public function test_far()
    // {
    //     $this->assertBlade(
    //         '<i class="far fa-address-book optional-extra-class"></i>',
    //         "@far('address-book', 'optional-extra-class')"
    //     );
    // }

    // public function test_fal()
    // {
    //     $this->assertBlade(
    //         '<i class="fal fa-address-book optional-extra-class"></i>',
    //         "@fal('address-book', 'optional-extra-class')"
    //     );
    // }

    // public function test_fab()
    // {
    //     $this->assertBlade(
    //         '<i class="fab fa-address-book optional-extra-class"></i>',
    //         "@fab('address-book', 'optional-extra-class')"
    //     );
    // }

    // public function test_mdi()
    // {
    //     $this->assertBlade(
    //         '<i class="mdi mdi-account optional-extra-class"></i>',
    //         "@mdi('account', 'optional-extra-class')"
    //     );
    // }

    // public function test_glyphicons()
    // {
    //     $this->assertBlade(
    //         '<i class="glyphicons glyphicons-glass optional-extra-class"></i>',
    //         "@glyph('glass', 'optional-extra-class')"
    //     );
    // }

    // public function test_data()
    // {
    //     $this->assertBlade(
    //         'data-foo="123" data-bar="baz"',
    //         "@data(['foo' => 123, 'bar' => 'baz'])"
    //     );
    // }

    // public function test_has_error()
    // {
    //     //without errors var
    //     $this->assertBlade(
    //         'Input: Has not errors',
    //         'Input:@haserror($errors->has(\'input_name\')) This input has an error @endhaserror Has not errors'
    //     );

    //     $errors = "new \Illuminate\Support\MessageBag(['input_name' => 1])";

    //     //with errors var
    //     $this->assertBlade(
    //         'Input: This input has an error',
    //         'Input:@haserror("input_name") This input has an error @endhaserror',
    //         [
    //             'errors' => $errors,
    //         ]
    //     );
    // }
}
