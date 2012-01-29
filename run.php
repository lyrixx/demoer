<?php
require_once __DIR__.'/vendor/.composer/autoload.php';

use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\PhpProcess;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Command;


$console = new Application();
$console->add(new Command\listCommand());
$console->add(new Command\runCommand($console));
$console->run();
