<?php

namespace App\Repository;

use App\Entity\EchangeClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EchangeClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method EchangeClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method EchangeClient[]    findAll()
 * @method EchangeClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EchangeClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EchangeClient::class);
    }

    // /**
    //  * @return EchangeClient[] Returns an array of EchangeClient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EchangeClient
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
