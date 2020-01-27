<?php

namespace App\Repository;

use App\Entity\Shipschedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Shipschedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shipschedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shipschedule[]    findAll()
 * @method Shipschedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipscheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shipschedule::class);
    }

    // /**
    //  * @return Shipschedule[] Returns an array of Shipschedule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Shipschedule
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
