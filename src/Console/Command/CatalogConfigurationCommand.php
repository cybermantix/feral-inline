<?php

namespace Feral\Inline\Console\Command;

use DataObject\Configuration;
use Feral\Core\Process\Catalog\Catalog;
use Reepository\ConfigurationRepository;
use Symfony\Component\Console\Attribute as Console;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[Console\AsCommand(
    name: 'feral:catalog:configuration',
    description: 'List the configuration for a catalog node.'
)]
class CatalogConfigurationCommand extends Command
{

    public function __construct(
        protected Catalog $catalog,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('key', InputArgument::REQUIRED, 'The Catalog Node Key?');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Feral Catalog Node Configuration');
        $key = $input->getArgument('key');
        $catalogNode = $this->catalog->getCatalogNode($key);
        $descriptions = $catalogNode->getConfigurationDescriptions();
        if (empty($descriptions)) {
            $output->writeln(sprintf(' - %s <info>(%s)</info> : <comment>Contains no configuration items.</comment>', $catalogNode->getName(), $catalogNode->getKey()));
        } else {
            foreach ($descriptions as $description) {
                $output->writeln(sprintf(" - %s <info>(%s)</info> : <comment>%s</comment>", $description->getName(), $description->getKey(), $description->getDescription()));
            }
        }
        return Command::SUCCESS;
    }
}