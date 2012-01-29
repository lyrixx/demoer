<?php
namespace Demoer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class listCommand extends snippetCommand
{
    public function __construct($snippets_path)
    {
        parent::__construct($snippets_path);
    }

    protected function configure()
    {
        $this
            ->setName('list-snippets')
            ->setDescription('List all snippets name in "snippets" dir')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = $this->listSnippets(new Finder());

        foreach ($finder->files() as $snippet) {
            $output->writeln($snippet->getFilename());
        }
    }
}