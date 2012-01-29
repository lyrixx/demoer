<?php

namespace Demoer\Command;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

abstract class Command extends BaseCommand
{
    protected $finder;

    public function __construct($name = null)
    {
        parent::__construct($name);

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
        return $this->getFinder()
            ->name('*.php')
            ->sortByName()
            ->in($path)
            ->files()
        ;
    }

    public function getFinder()
    {
        return $this->getApplication()->getFinder();
    }

}