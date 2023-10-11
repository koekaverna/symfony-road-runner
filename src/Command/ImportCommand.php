<?php

declare(strict_types=1);

namespace App\Command;

use App\Exchange\Currency;
use App\Exchange\Importer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:import',
    description: 'Import exchange rates',
)]
final class ImportCommand extends Command
{

    public function __construct(
        private Importer $importer,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Importing exchange rates...');

        $this->importer->import(Currency::USD);

        return Command::SUCCESS;
    }
}
