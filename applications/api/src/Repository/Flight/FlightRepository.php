<?php

declare(strict_types=1);

namespace App\Repository\Flight;

use App\Entity\Flight\Flight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<\App\Entity\Flight\Flight>
 *
 * @method Flight|null find($id, $lockMode = null, $lockVersion = null):
 * @method Flight|null findOneBy(array $criteria, ?array $orderBy = null)
 * @method Flight[]    findAll()
 * @method Flight[]    findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 */
class FlightRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flight::class);
    }

    public function getDepartureFlightsByCode(?string $codeDeparture): QueryBuilder
    {
        $qb = $this->createQueryBuilder('f');

        $qb->andWhere('f.codeDeparture = :codeDeparture');
        $qb->setParameter('codeDeparture', $codeDeparture);
        $qb->addOrderBy('f.price', 'DESC');

        return $qb;
    }

    public function getArrivalFlightsByCode(?string $codeArrival): QueryBuilder
    {
        $qb = $this->createQueryBuilder('f');

        $qb->andWhere('f.codeArrival = :codeArrival');
        $qb->setParameter('codeArrival', $codeArrival);
        $qb->addOrderBy('f.price', 'DESC');

        return $qb;
    }
}
