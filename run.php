<?php
require_once __DIR__.'/vendor/.composer/autoload.php';

use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\PhpProcess;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Demoer\Command;

$snippets_path = __DIR__ . '/snippets/';
$console = new Application();
$console->add(new Command\listCommand($snippets_path));
$console->add(new Command\runCommand($snippets_path, $console));
$console->run();
