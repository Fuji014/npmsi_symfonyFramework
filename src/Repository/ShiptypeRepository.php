<?php

namespace App\Repository;

use App\Entity\Shiptype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Shiptype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shiptype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shiptype[]    findAll()
 * @method Shiptype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShiptypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shiptype::class);
    }

    // /**
    //  * @return Shiptype[] Returns an array of Shiptype objects
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
    public function findOneBySomeField($value): ?Shiptype
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
