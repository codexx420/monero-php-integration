#!/usr/bin/env php
<?php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Monero\Commands\TestCommand;

$application = new Application('mo', '1.0.0');

$command = new TestCommand();

$application->add($command);

$application->setDefaultCommand($command->getName(), true);
$application->run();