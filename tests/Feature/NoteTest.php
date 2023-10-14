<?php

use QuantaForge\Prompts\Prompt;

use function QuantaForge\Prompts\note;

it('renders a note', function () {
    Prompt::fake();

    note('Hello, World!');

    Prompt::assertOutputContains('Hello, World!');
});
