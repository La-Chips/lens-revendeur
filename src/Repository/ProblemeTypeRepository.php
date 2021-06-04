<?php

namespace App\Repository;

use App\Entity\ProblemeType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProblemeType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProblemeType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProblemeType[]    findAll()
 * @method ProblemeType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProblemeTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProblemeType::class);
    }

    // /**
    //  * @return ProblemeType[] Returns an array of ProblemeType objects
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
    public function findOneBySomeField($value): ?ProblemeType
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
