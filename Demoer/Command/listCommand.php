<?php

namespace Demoer\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('list-snippets')
            ->setDescription('List all snippets name in "snippets" dir')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $snippetsPath = $input->getOption('snippets-path');
        $snippetsPathInfo = new \SplFileInfo($snippetsPath);

        foreach ($this->listSnippets($snippetsPath) as $snippet) {
            $output->writeln(substr($snippet->getRealpath(), strlen($snippetsPathInfo->getRealpath())+1));
        }
    }
}