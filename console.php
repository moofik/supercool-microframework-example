<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application as ConsoleApplication;
use App\Command\CreateDatabaseCommand;

$argumentResolver = (new \App\Application())->getArgumentResolver();
$application = new ConsoleApplication();

$application->add($argumentResolver->buildClassInstance(CreateDatabaseCommand::class));

$application->run();