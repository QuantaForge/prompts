<?php

use function QuantaQuirk\Prompts\alert;
use function QuantaQuirk\Prompts\error;
use function QuantaQuirk\Prompts\info;
use function QuantaQuirk\Prompts\intro;
use function QuantaQuirk\Prompts\note;
use function QuantaQuirk\Prompts\outro;
use function QuantaQuirk\Prompts\warning;

require __DIR__.'/../vendor/autoload.php';

intro('Intro');
note('Note');
info('Info');
warning('Warning');
error('Error');
alert('Alert');
outro('Outro');
