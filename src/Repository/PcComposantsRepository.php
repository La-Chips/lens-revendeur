<?php

namespace App\Repository;

use App\Entity\PcComposants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PcComposants|null find($id, $lockMode = null, $lockVersion = null)
 * @method PcComposants|null findOneBy(array $criteria, array $orderBy = null)
 * @method PcComposants[]    findAll()
 * @method PcComposants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PcComposantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PcComposants::class);
    }

    // /**
    //  * @return PcComposants[] Returns an array of PcComposants objects
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
    public function findOneBySomeField($value): ?PcComposants
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
