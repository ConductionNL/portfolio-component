<?php

namespace App\Repository;

use App\Entity\FormalRecognition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormalRecognition|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormalRecognition|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormalRecognition[]    findAll()
 * @method FormalRecognition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormalRecognitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormalRecognition::class);
    }

    // /**
    //  * @return FormalRecognition[] Returns an array of FormalRecognition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormalRecognition
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
