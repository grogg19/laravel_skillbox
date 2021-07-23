<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Symfony\Component\Console;
use App\StringsTransform\CamelCaseCommand;

$app = new Console\Application('Make CameCase string');
$app->add( new CamelCaseCommand());

$app->run();
