<?php

namespace App\Repository;

use App\Entity\Chauffage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Chauffage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chauffage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chauffage[]    findAll()
 * @method Chauffage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChauffageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chauffage::class);
    }

    // /**
    //  * @return Chauffage[] Returns an array of Chauffage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Chauffage
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
