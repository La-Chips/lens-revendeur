<?php

namespace App\Repository;

use App\Entity\Reparation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reparation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reparation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reparation[]    findAll()
 * @method Reparation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReparationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reparation::class);
    }

    // /**
    //  * @return Reparation[] Returns an array of Reparation objects
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
    public function findOneBySomeField($value): ?Reparation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
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
            ->where('d.numero like :q OR c.nom LIKE :q OR c.prenom LIKE :q ');

        switch ($status) {
            case 'processing':
                $qb->andWhere('d.status = 3');
                break;
            case 'diag':
                $qb->andWhere('d.status = 12');
                break;
            case 'devis':
                $qb->innerJoin('d.devis', 'de');
                break;
            case 'finish':
                $qb->andWhere('d.status = 15');
                break;
            case 'cancel':
                $qb->andWhere('d.status = 4');
                break;
            case 'waiting':
                $qb->andWhere('d.status = 13');
                break;
            case 'progress':
                $qb->andWhere('d.status = 16');
                break;
        }

        $qb
            ->setParameter('q', '%' . $q . '%')
            ->orderBy('d.date', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function countAll()
    {
        $qb = $this->createQueryBuilder('r')
            ->select('count(r.numero)');

        return $qb->getQuery()->getSingleScalarResult();
    }
}
