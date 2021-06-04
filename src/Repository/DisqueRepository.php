<?php

namespace App\Repository;

use App\Entity\Disque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Disque|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disque|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disque[]    findAll()
 * @method Disque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disque::class);
    }

    // /**
    //  * @return Disque[] Returns an array of Disque objects
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
    public function findOneBySomeField($value): ?Disque
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
