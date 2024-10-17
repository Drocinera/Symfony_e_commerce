<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class RunTestsCommand extends Command
{
    protected static $defaultName = 'app:run-tests';

    protected function configure()
    {
        $this->setName('app:run-tests')
            ->setDescription('Exécute les tests PHPUnit au démarrage de l\'application.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Lancement des tests...');

        $process = new Process(['php', 'bin/phpunit']);
        $process->run(function ($type, $buffer) use ($output) {
            $output->write($buffer);
        });

        return Command::SUCCESS;
    }
}
