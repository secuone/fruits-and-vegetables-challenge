<?php

namespace VeggieVibe\Shared\Infrastructure\Symfony\Command;

use InvalidArgumentException;
use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Fruit\Domain\FruitRepository;
use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Vegetable\Domain\VegetableRepository;
use VeggieVibe\Shared\Domain\ValueObject\ItemType;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use VeggieVibe\Shared\Domain\PrimitiveItem;

#[AsCommand(
    name: 'app:load-request-data',
    description: 'Load data from the request.json file (located in the root folder) into the database.',
    aliases: ['app:load-request-data']
)]
class LoadRequestDataCommand extends Command
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly DenormalizerInterface $fruitDenormalizer,
        private readonly DenormalizerInterface $vegetableDenormalizer,
        private readonly VegetableRepository $vegetableRepository,
        private readonly FruitRepository $fruitRepository
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('filePath', InputArgument::REQUIRED, 'Json file path');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Check if file exists
        $io->title('The saving process has started.');
        $filePath = $input->getArgument('filePath');

        if (!file_exists($filePath)) {
            $io->error('The specified file does not exist.');
            return Command::FAILURE;
        }

        $io->info('Flushing redis...');
        $this->vegetableRepository->deleteAll();
        $this->fruitRepository->deleteAll();
        $io->info('Redis flushed successfully.');

        // Read json file
        $io->info('Decoding json...');
        $primitiveItems = $this->serializer->deserialize(file_get_contents($filePath), PrimitiveItem::class.'[]', 'json');
        $io->info('Json decoded successfully.');

        $io->info('Adding items...');
        array_map(function ($primitiveItem) {
            return match (ItemType::from($primitiveItem->type())) {
                ItemType::FRUIT => $this->processFruit($primitiveItem),
                ItemType::VEGETABLE => $this->processVegetable($primitiveItem),
                default => throw new InvalidArgumentException('Unknown item type: ' . $primitiveItem->type()),
            };
        }, $primitiveItems);

        $io->success('The process has been completed successfully.');

        return Command::SUCCESS;
    }

    private function processFruit(PrimitiveItem $json): void
    {
        $fruit = $this->fruitDenormalizer->denormalize($json, Fruit::class, 'json');

        $this->fruitRepository->save($fruit);
    }

    private function processVegetable(PrimitiveItem $json): void
    {
        $vegetable = $this->vegetableDenormalizer->denormalize($json, Vegetable::class, 'json');

        $this->vegetableRepository->save($vegetable);
    }
}