<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Finder\Finder;
use Demoer\Application\Application;
use Demoer\Command\ListCommand;
use Demoer\Command\RunCommand;

$console = new Application(new Finder());

$console->add(new ListCommand());
$console->add(new RunCommand());

$console->run();
