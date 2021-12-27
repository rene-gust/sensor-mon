<?php

namespace App\Repository;

use App\Entity\SensorRecordUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SensorRecordUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method SensorRecordUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method SensorRecordUnit[]    findAll()
 * @method SensorRecordUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SensorRecordUnitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SensorRecordUnit::class);
    }

    // /**
    //  * @return SensorRecordUnit[] Returns an array of SensorRecordUnit objects
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
    public function findOneBySomeField($value): ?SensorRecordUnit
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
