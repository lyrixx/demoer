<?php

require_once __DIR__.'/vendor/.composer/autoload.php';

use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Application;

use Demoer\Command;

$console = new Application();

$finder = new Finder();

$console->add(new Command\listCommand($finder));
$console->add(new Command\runCommand($finder));

$console->run();
