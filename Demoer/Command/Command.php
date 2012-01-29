<?php

namespace Demoer\Command;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Finder\Finder;

abstract class Command extends BaseCommand
{
    protected $finder;

    public function __construct(Finder $finder, $name = null)
    {
        parent::__construct($name);

        $this->finder = $finder;
        $this->addOption('snippets-path', null, InputOption::VALUE_OPTIONAL, 'Path to the snippets', __DIR__.'/../../snippets');
    }

    protected function hr(OutputInterface $output, $size = 80, $string = '=')
    {
        $output->writeln('');
        $output->writeln('<comment>'.str_repeat($string, $size).'</comment>');
        $output->writeln('');
    }

    protected function listSnippets($path)
    {
        return $this->finder
            ->name('*.php')
            ->sortByName()
            ->in($path)
            ->files()
        ;
    }
}