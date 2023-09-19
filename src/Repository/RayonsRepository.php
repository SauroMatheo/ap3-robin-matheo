<?php

namespace App\Repository;

use App\Entity\Rayons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rayons>
 *
 * @method Rayons|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rayons|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rayons[]    findAll()
 * @method Rayons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RayonsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rayons::class);
    }

//    /**
//     * @return Rayons[] Returns an array of Rayons objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Rayons
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
