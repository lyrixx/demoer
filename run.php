<?php

define('SNIPPETS_DIR', __DIR__.'/snippets');
require_once __DIR__.'/vendor/.composer/autoload.php';

use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\PhpProcess;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Command\listCommand;
use Command\runCommand;


$console = new Application();
$console->add(new listCommand());
$console->add(new runCommand($console));
$console->run();
