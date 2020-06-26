<?php

namespace App\Repository;

use App\Entity\Nieuws;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nieuws|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nieuws|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nieuws[]    findAll()
 * @method Nieuws[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NieuwsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nieuws::class);
    }

    // /**
    //  * @return Nieuws[] Returns an array of Nieuws objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nieuws
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
