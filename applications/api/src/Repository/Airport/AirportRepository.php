<?php

declare(strict_types=1);

namespace App\Repository\Airport;

use App\Entity\Airport\Airport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<\App\Entity\Airport\Airport>
 *
 * @method Airport|null find($id, $lockMode = null, $lockVersion = null):
 * @method Airport|null findOneBy(array $criteria, ?array $orderBy = null)
 * @method Airport[]    findAll()
 * @method Airport[]    findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 */
class AirportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Airport::class);
    }

    public function getAirportByCode(?string $code): Airport
    {
        $qb = $this->createQueryBuilder('a');

        $qb->andWhere('a.code = :code');
        $qb->setParameter('code', $code);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();
        try {
            $airport = $query->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $airport = null;
        }

        return $airport;
    }
}
