<?php

namespace App\Repository;

use App\Entity\Destination;
use App\Entity\DestinationSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Destination|null find($id, $lockMode = null, $lockVersion = null)
 * @method Destination|null findOneBy(array $criteria, array $orderBy = null)
 * @method Destination[]    findAll()
 * @method Destination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DestinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Destination::class);
    }

    /**
     * @param DestinationSearch $search
     * @return Destination[]
     */
    public function findSearched(DestinationSearch $search){

        $destinations=$this->findAll();
        $a=0;
        $query= $this->createQueryBuilder('d');
        if($search->getMaxPopulation() != null){
            $a=1;
            $query=

                $query->andWhere('d.Population < :maxprice')
                ->setParameter('maxprice' , $search->getMaxPopulation());

        }
        if($search->getMinSurface() != null){
            $a=1;
            $query=

                $query->andWhere('d.Superficie > :minsurface')
                    ->setParameter('minsurface' , $search->getMinSurface());
        }
         if($search->getNom() != null){
             $a=1;
            $query=

                $query->andWhere('d.NomDes = :nomdes')
                    ->setParameter('nomdes' , $search->getNom());
        }


        if($a == 1){return$query->getQuery()->getResult(); }else{
            return $destinations;
        }

    }
   /**
     *@param DestinationSearch $search
     * @return Destination[]
     */
    public function findSorted(DestinationSearch $search){

        $destinations=$this->createQueryBuilder('d')->orderBy('d.NomDes')->getQuery()->getResult();


        $a=0;
        $query= $this->createQueryBuilder('d');
        if($search->getMaxPopulation() != null){
            $a=1;
            $query=

                $query->andWhere('d.Population < :maxprice')
                    ->setParameter('maxprice' , $search->getMaxPopulation());

        }
        if($search->getMinSurface() != null){
            $a=1;
            $query=

                $query->andWhere('d.Superficie > :minsurface')
                    ->setParameter('minsurface' , $search->getMinSurface());
        }
        if($search->getNom() != null){
            $a=1;
            $query=

                $query->andWhere('d.NomDes = :nomdes')
                    ->setParameter('nomdes' , $search->getNom());
        }


        if($a == 1){return$query->orderBy('d.NomDes')->getQuery()->getResult(); }else{
            return $destinations;
        }


    }


    // /**
    //  * @return Destination[] Returns an array of Destination objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Destination
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
