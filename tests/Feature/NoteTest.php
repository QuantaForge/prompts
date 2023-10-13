<?php

use QuantaQuirk\Prompts\Prompt;

use function QuantaQuirk\Prompts\note;

it('renders a note', function () {
    Prompt::fake();

    note('Hello, World!');

    Prompt::assertOutputContains('Hello, World!');
});
