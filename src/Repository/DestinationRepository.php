<?php

namespace App\Repository;

use App\Entity\Destination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Destination>
 */
class DestinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Destination::class);
    }

    /**
     * @return mixed
     */
    public function findAllQuery(): mixed
    {
        return $this->createQueryBuilder('d')
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ;
    }
}
