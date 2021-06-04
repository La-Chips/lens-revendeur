<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    public function findByFilter($q, $status)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.client', 'c')
            ->where('p.numero like :q OR c.nom LIKE :q OR c.prenom LIKE :q ')
            ->andWhere('p.numero not like :f');

        switch ($status) {
            case 'processing':
                $qb->andWhere('p.status = 3');
                break;
            case 'sav':
                $qb->andWhere('p.status = 6');
                break;
            case 'assemblage':
                $qb->andWhere('p.status = 2');
                break;
            case 'reservation':
                $qb->andWhere('p.status = 5');
                break;
            case 'shipping':
                $qb->andWhere('p.status = 1');
                break;
            case 'late':
                $qb->andWhere(
                    'p.dateLimiteExp < CURRENT_DATE() AND p.status not in (1,4,7)'
                );
                break;
            case 'install':
                $qb->andWhere('p.status = 19');

                break;
            case 'cancel':
                $qb->andWhere('p.status = 4');
                break;
        }

        $qb
            ->setParameter('q', '%' . $q . '%')
            ->setParameter('f', '%FOURNISSEUR%')
            ->orderBy('p.dateOrder', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function countSupplierOrder()
    {
        $q = $this->createQueryBuilder('c')
            ->select('count(c.fournisseur)')
            ->getQuery()
            ->getSingleScalarResult();
        return $q;
    }
    public function countShopOrder()
    {
        $q = $this->createQueryBuilder('c')
            ->select('count(c.numero)')
            ->where('c.numero LIKE :q')
            ->setParameter('q', '%BTQ%')
            ->getQuery()
            ->getSingleScalarResult();
        return $q;
    }
    public function countStockOrder()
    {
        $q = $this->createQueryBuilder('c')
            ->select('count(c.numero)')
            ->where('c.numero LIKE :q')
            ->setParameter('q', '%STOCK%')
            ->getQuery()
            ->getSingleScalarResult();
        return $q;
    }

    public function findByDelaySupplier()
    {
        $q = $this->createQueryBuilder('c')
            ->where('c.fournisseur is not null AND c.dateExp is not null')
            ->getQuery()
            ->getResult();
        return $q;
    }
}