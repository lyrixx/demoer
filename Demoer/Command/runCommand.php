<?php
namespace Demoer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\PhpProcess;
use InvalidArgumentException;

class runCommand extends snippetCommand
{
    function __construct($snippets_path)
    {
        parent::__construct($snippets_path);
    }

    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Run one, or all snippets')
            ->addArgument('filename', InputArgument::OPTIONAL, 'snippet filename, if empty, run every snippets')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('filename');

        if (null !== $filename) {
            $filename = $this->getSnippetsPath().DIRECTORY_SEPARATOR.$filename;
            if (!file_exists($filename)) {
                throw new InvalidArgumentException(sprintf('file "%s" does not exist', $filename));
            }
            $snippets = array(new \SplFileInfo($filename));
            $nbSnippets = 1;
        } else {
            $snippets = $this->listSnippets(new Finder());
            $nbSnippets = count($snippets->getIterator()->getIterator());
        }

        $dialog = $this->getHelperSet()->get('dialog');
        $i = 0;
        foreach ($snippets as $snippet) {
            $snippetCode = file_get_contents($snippet->getRealpath());

            $output->writeln(sprintf('<info>DEMO [%d/%d]:</info> %s', $i+1, $nbSnippets, $snippet->getRealPath()));

            $this->hr($output, 20);

            $output->writeln('<info>CODE :</info>');
            $output->writeln($snippetCode);

            $this->hr($output, 20);

            $dialog->askConfirmation($output, '<question>Press enter to see result</question>');

            $output->writeln('<info>RESULT :</info>');
            $process = new PhpProcess($snippetCode);
            $process->run();
            if (!$process->isSuccessful()) {
                $output->writeln(array('<error>Error ::</error>', $process->getErrorOutput()));
            }
            $output->writeln(array('<comment>Output ::</comment>', $process->getOutput()));

            $this->hr($output);

            $i++;

            if ($i < $nbSnippets) {
                $dialog->askConfirmation($output, '<question>Press enter to continue</question>');
                $output->writeln("\033[2J");
            }
        }
    }
}