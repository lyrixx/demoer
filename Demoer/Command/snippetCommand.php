<?php
namespace Demoer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

abstract class snippetCommand extends Command
{   
    protected $snippets_path;

    function __construct($snippets_path)
    {
        parent::__construct(null);
        $this->snippets_path = $snippets_path;
    }

    protected function hr(OutputInterface $output, $size = 80, $string = '=')
    {
        $output->writeln('');
        $output->write('<comment>'.str_repeat($string, $size).'</comment>');
        $output->writeln('');
        $output->writeln('');
    }

    protected function listSnippets(Finder $finder)
    {
        return $finder
            ->files()
            ->name('*.php')
            ->sortByName()
            ->in($this->snippets_path)
        ;
    }

    /** 
     * @return string
     */
    public function getSnippetsPath()
    {
        return $this->snippets_path;
    }
    
    /**
     * @param $snippets_path
     * @return void
     */
    public function setSnippetsPath($snippets_path)
    {
        $this->snippets_path = $snippets_path;
    }
}