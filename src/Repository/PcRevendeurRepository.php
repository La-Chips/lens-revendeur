<?php

namespace App\Repository;

use App\Entity\PcRevendeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PcRevendeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method PcRevendeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method PcRevendeur[]    findAll()
 * @method PcRevendeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PcRevendeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PcRevendeur::class);
    }

    // /**
    //  * @return PcRevendeur[] Returns an array of PcRevendeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PcRevendeur
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
