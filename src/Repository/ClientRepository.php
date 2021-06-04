<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function findByFilter($q)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.nom LIKE :q or p.prenom LIKE :q')
            ->orderBy('p.id', 'DESC')
            ->setParameter('q', '%' . $q . '%');

        return $qb->getQuery()->getResult();
    }

    public function findOneByConcat($value): ?Client
    {
        return $this->createQueryBuilder('c')
            ->andWhere('CONCAT(c.nom, \' \',c.prenom) = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}