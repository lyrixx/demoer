<?php
namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

abstract class snippetCommand extends Command
{   
    function __construct($name = null)
    {
        parent::__construct($name = null);
        define('SNIPPETS_DIR', __DIR__.'/../snippets');
    }

    protected function hr(OutputInterface $output, $size = 80, $string = '=')
    {
        $output->writeln('');
        $output->write('<comment>'.str_repeat($string, $size).'</comment>');
        $output->writeln('');
        $output->writeln('');
    }

    protected function listSnippets(Finder $finder) {

        return $finder
        ->files()
        ->name('*.php')
        ->sortByName()
        ->in(SNIPPETS_DIR)
        ;
    }
}