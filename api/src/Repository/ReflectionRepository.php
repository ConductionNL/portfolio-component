<?php

namespace App\Repository;

use App\Entity\Reflection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reflection|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reflection|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reflection[]    findAll()
 * @method Reflection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReflectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reflection::class);
    }

    // /**
    //  * @return Reflection[] Returns an array of Reflection objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reflection
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
