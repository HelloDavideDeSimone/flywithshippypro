<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Airport\Airport;
use App\Entity\Flight\Flight;
use App\Repository\Airport\AirportRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class AirportFixtures extends Fixture
{
    use LoadDumpsTrait;

    private AirportRepository $airportRepository;
    private ManagerRegistry $registry;

    public function __construct(AirportRepository $airportRepository, ManagerRegistry $registry)
    {
        $this->airportRepository = $airportRepository;
        $this->registry = $registry;
    }

    /**
     * @param array<int, Airport> $airports
     * @param array<int, Airport> $airportsToExclude
     **/
    private static function getAnotherAirport(array $airports, array $airportsToExclude): Airport
    {
        $airportsWithoutSelectedAirport = array_values(array_udiff($airports, $airportsToExclude, function ($obj_a, $obj_b): int {
            return strcmp((string) ($obj_a->getId()), (string) ($obj_b->getId()));
        }));
        $randomIndex = rand(0, \count($airportsWithoutSelectedAirport) - 1);

        return $airportsWithoutSelectedAirport[$randomIndex];
    }

    public function load(ObjectManager $manager): void
    {
        /** @var Connection $connection */
        $connection = $this->registry->getConnection();
        $this->loadDumps($connection, __DIR__ . '/../../dump');

        echo '* Loaded dumps.' . \PHP_EOL;

        $airports = $this->airportRepository->findAll();

        /** @var Airport $airport */
        foreach ($airports as $airport) {
            $airportsToExclude = [$airport];
            $nbFlights = rand(1, 6);

            for ($i = 0; $i < $nbFlights; ++$i) {
                $anotherAirport = self::getAnotherAirport($airports, $airportsToExclude);
                $airportsToExclude[] = $anotherAirport;

                $scale = 10 ** 2;
                $randomFloat = mt_rand(10 * $scale, 160 * $scale) / $scale;

                $flight = new Flight();
                $flight->setCodeDeparture($airport->getCode());
                $flight->setCodeArrival($anotherAirport->getCode());
                $flight->setPrice($randomFloat);
                $manager->persist($flight);
            }
        }
        $manager->flush();
    }
}
