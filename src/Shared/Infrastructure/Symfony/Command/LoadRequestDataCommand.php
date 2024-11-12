<?php

namespace VeggieVibe\Shared\Infrastructure\Symfony\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:load-request-data',
    description: 'Load data from the request.json file (located in the root folder) into the database.',
    aliases: ['app:load-request-data']
)]
class LoadRequestDataCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Whoa!');

        return Command::SUCCESS;
    }
}