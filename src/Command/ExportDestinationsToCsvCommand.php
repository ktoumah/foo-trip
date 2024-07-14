<?php

namespace App\Command;

use App\Service\Csv\ApiDataToCsvFormatterInterface;
use App\Service\ExternalAPI\FooTripAPIInterface;
use App\Utils\CsvGeneratorInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:export-destinations-to-csv',
    description: 'Retrieve all destinations from Foo Trip API and export them into a CSV file',
)]
class ExportDestinationsToCsvCommand extends Command
{
    public function __construct(
        private readonly FooTripAPIInterface $fooTripAPI,
        private readonly CsvGeneratorInterface $csvGenerator,
        private readonly string $csv_folder,
        private readonly ApiDataToCsvFormatterInterface $apiDataToCsvFormatter,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('offset', null, InputOption::VALUE_NONE, 'Offset')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $offset = $input->getOption('offset');
        if (!$offset) {
            $offset = 0;
        }

        $destinations = $this->fooTripAPI->getAllDestinations($offset)['data'];

        $destinations = $this->apiDataToCsvFormatter->fromDestinationToCsvFormat($destinations);

        if (!file_exists($this->csv_folder))
            mkdir($this->csv_folder, 0777, true);

        $folder_path = $this->csvGenerator->generate($destinations, $this->csv_folder. '/' . time());

        $io->success("Destinations are retrieved and exported to [$folder_path].");

        return Command::SUCCESS;
    }
}
