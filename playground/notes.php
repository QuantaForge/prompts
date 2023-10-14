<?php

use function QuantaForge\Prompts\alert;
use function QuantaForge\Prompts\error;
use function QuantaForge\Prompts\info;
use function QuantaForge\Prompts\intro;
use function QuantaForge\Prompts\note;
use function QuantaForge\Prompts\outro;
use function QuantaForge\Prompts\warning;

require __DIR__.'/../vendor/autoload.php';

intro('Intro');
note('Note');
info('Info');
warning('Warning');
error('Error');
alert('Alert');
outro('Outro');
