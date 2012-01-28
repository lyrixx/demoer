<?php

define('SNIPPETS_DIR', __DIR__.'/snippets');

use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\PhpProcess;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

require_once __DIR__.'/vendor/.composer/autoload.php';

$console = new Application();

$console
    ->register('list-snippets')
    ->setDescription('List all snippets name in "snippets" dir')
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        foreach (listSnippets(new Finder()) as $snippet) {
            $output->writeln(substr($snippet->getRealpath(), strlen(SNIPPETS_DIR)+1));
        }
    })
;

$console
    ->register('run')
    ->setDescription('Run one, or all snippets')
    ->setDefinition(array(
        new InputArgument('filename', InputArgument::OPTIONAL, 'snippet filename, if empty, run every snippets'),
    ))
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($console) {
        $filename = $input->getArgument('filename');

        if (null !== $filename) {
            $filename = SNIPPETS_DIR.DIRECTORY_SEPARATOR.$filename;
            if (!file_exists($filename)) {
                throw new InvalidArgumentException(sprintf('file "%s" does not exist', $filename));
            }
            $snippets = array(new \SplFileInfo($filename));
            $nbSnippets = 1;
        } else {
            $snippets = listSnippets(new Finder());
            $nbSnippets = count($snippets->getIterator()->getIterator());
        }

        $dialog = $console->getHelperSet()->get('dialog');
        $i = 0;
        foreach ($snippets as $snippet) {
            $snippetCode = file_get_contents($snippet->getRealpath());

            $output->writeln(sprintf('<info>DEMO [%d/%d]:</info> %s', $i+1, $nbSnippets, $snippet->getRealPath()));

            hr($output, 20);

            $output->writeln('<info>CODE :</info>');
            $output->writeln($snippetCode);

            hr($output, 20);

            $dialog->askConfirmation($output, '<question>Press enter to see result</question>');

            $output->writeln('<info>RESULT :</info>');
            $process = new PhpProcess($snippetCode);
            $process->run();
            if (!$process->isSuccessful()) {
                $output->writeln(array('<error>Error ::</error>', $process->getErrorOutput()));
            }
            $output->writeln(array('<comment>Output ::</comment>', $process->getOutput()));

            hr($output);

            $i++;

            if ($i < $nbSnippets) {
                $dialog->askConfirmation($output, '<question>Press enter to continue</question>');
                $output->writeln("\033[2J");
            }
        }
    })
;

$console->run();


function listSnippets(Finder $finder) {
    return $finder
        ->files()
        ->name('*.php')
        ->sortByName()
        ->in(SNIPPETS_DIR)
    ;
}

function hr(OutputInterface $output, $size = 80, $string = '=') {
    $output->writeln('');
    $output->write('<comment>'.str_repeat($string, $size).'</comment>');
    $output->writeln('');
    $output->writeln('');
}
