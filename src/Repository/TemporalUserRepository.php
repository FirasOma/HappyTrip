<?php

namespace App\Repository;

use App\Entity\TemporalUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TemporalUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemporalUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemporalUser[]    findAll()
 * @method TemporalUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemporalUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TemporalUser::class);
    }

    // /**
    //  * @return TemporalUser[] Returns an array of TemporalUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TemporalUser
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
