<?php

namespace App\Command;

use App\Repository\LocationRepository;
use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'weather:location',
    description: 'Shows weather forecast for location by ID',
)]
class WeatherLocationCommand
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly WeatherUtil $weatherUtil,
    ) {
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Argument('Location ID')] int $id,
    ): int {
        $location = $this->locationRepository->find($id);

        if (!$location) {
            $io->error(sprintf('Location with ID %d not found', $id));
            return Command::FAILURE;
        }

        $forecasts = $this->weatherUtil->getWeatherForLocation($location);

        $io->writeln(sprintf('Location: %s, %s', $location->getName(), $location->getCountry()));
        $io->table(['Date', 'Temperature'], array_map(fn($f) => [
            $f->getDate()->format('Y-m-d'),
            $f->getTemperature(),
        ], $forecasts));

        return Command::SUCCESS;
    }
}
