<?php

namespace App\Repository;

use App\Entity\Devis;
use App\Entity\Commande;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Devis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Devis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Devis[]    findAll()
 * @method Devis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Devis::class);
    }

    // /**
    //  * @return Devis[] Returns an array of Devis objects
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
    public function findOneBySomeField($value): ?Devis
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByFilter($q, $status)
    {
        $qb = $this->createQueryBuilder('d')
            ->innerJoin('d.client', 'c')
            ->where('d.numero like :q OR c.nom LIKE :q OR c.prenom LIKE :q ')
            ->andWhere('d.reparation is null');

        switch ($status) {
            case 'accept':
                $qb->andWhere('d.status = 14');
                break;
            case 'processing':
                $qb->andWhere('d.status = 3');
                break;
            case 'deny':
                $qb->andWhere('d.status = 4');
                break;
            case 'waiting':
                $qb->andWhere('d.status = 13');
                break;
            case 'ready':
                $qb->andWhere('d.status = 14');
                break;
        }

        $qb
            ->setParameter('q', '%' . $q . '%')
            ->orderBy('d.date', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function countAll()
    {
        $qb = $this->createQueryBuilder('d')
            ->select('count(d.numero)');

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function countRep()
    {
        $qb = $this->createQueryBuilder('d')
            ->select('count(d.numero)')
            ->where('d.reparation is not null');

        return $qb->getQuery()->getSingleScalarResult();
    }
}