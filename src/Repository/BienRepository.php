<?php

namespace App\Repository;

use App\Entity\Bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }

    public function simpleSearch($localisation = "", $prixMax = 9999999999999, $surfaceMin = -1, $bonus = '')
    {
        $qb = $this->createQueryBuilder('bien');
        $query = $qb->select('bien')
            ->where('bien.ville LIKE :ville')
            ->setParameter('ville', '%' . $localisation . '%')
            ->andWhere('bien.prix < :prixMax')
            ->setParameter('prixMax', intval($prixMax))
            ->andWhere('bien.surface > :surfaceMin')
            ->setParameter('surfaceMin', intval($surfaceMin));

        if ($bonus == 'maison') {
            $query = $qb->andWhere('bien.type_de_bien = 2');
        }

        if ($bonus == 'colocation') {
            $query = $qb->andWhere('bien.colocation = 1');
        }
        if ($bonus == 'parking') {
            $query = $qb->andWhere('bien.parking = 1');
        }
        if ($bonus == 'balcon') {
            $query = $qb->andWhere('bien.balcon = 1');
        }


        $query = $qb->getQuery();
        $results = $query->getResult();
        return $results;
    }

    // /**
    //  * @return Bien[] Returns an array of Bien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bien
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
