<?php

namespace App\Repository;

use App\Entity\VoyageVirtuelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VoyageVirtuelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoyageVirtuelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoyageVirtuelle[]    findAll()
 * @method VoyageVirtuelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageVirtuelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoyageVirtuelle::class);
    }

    // /**
    //  * @return VoyageVirtuelle[] Returns an array of VoyageVirtuelle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VoyageVirtuelle
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
