<?php

use function QuantaForge\Prompts\alert;
use function QuantaForge\Prompts\confirm;
use function QuantaForge\Prompts\error;
use function QuantaForge\Prompts\intro;
use function QuantaForge\Prompts\multiselect;
use function QuantaForge\Prompts\note;
use function QuantaForge\Prompts\outro;
use function QuantaForge\Prompts\password;
use function QuantaForge\Prompts\select;
use function QuantaForge\Prompts\spin;
use function QuantaForge\Prompts\suggest;
use function QuantaForge\Prompts\text;
use function QuantaForge\Prompts\warning;

require __DIR__.'/../vendor/autoload.php';

intro('Welcome to QuantaForge');

$name = suggest(
    label: 'What is your name?',
    placeholder: 'E.g. Taylor Otwell',
    options: [
        'Dries Vints',
        'Guus Leeuw',
        'James Brooks',
        'Jess Archer',
        'Joe Dixon',
        'Mior Muhammad Zaki Mior Khairuddin',
        'Nuno Maduro',
        'Taylor Otwell',
        'Tim MacDonald',
    ],
    validate: fn ($value) => match (true) {
        ! $value => 'Please enter your name.',
        default => null,
    },
);

$path = text(
    label: 'Where should we create your project?',
    placeholder: 'E.g. ./quantaforge',
    validate: fn ($value) => match (true) {
        ! $value => 'Please enter a path',
        $value[0] !== '.' => 'Please enter a relative path',
        default => null,
    },
);

$password = password(
    label: 'Provide a password',
    validate: fn ($value) => match (true) {
        ! $value => 'Please enter a password.',
        strlen($value) < 5 => 'Password should have at least 5 characters.',
        default => null,
    },
);

$type = select(
    label: 'Pick a project type',
    default: 'ts',
    options: [
        'ts' => 'TypeScript',
        'js' => 'JavaScript',
    ],
);

$tools = multiselect(
    label: 'Select additional tools.',
    default: ['pint', 'eslint'],
    options: [
        'pint' => 'Pint',
        'eslint' => 'ESLint',
        'prettier' => 'Prettier',
    ],
    validate: function ($values) {
        if (count($values) === 0) {
            return 'Please select at least one tool.';
        }
    }
);

$install = confirm(
    label: 'Install dependencies?',
);

if ($install) {
    spin(fn () => sleep(3), 'Installing dependencies...');
}

error('Error');
warning('Warning');
alert('Alert');

note(<<<EOT
    Installation complete!

    To get started, run:

        cd {$path}
        php artisan serve
    EOT);

outro('Happy coding!');

var_dump(compact('name', 'path', 'password', 'type', 'tools', 'install'));
