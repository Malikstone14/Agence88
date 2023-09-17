<?php

namespace App\Repository;

use App\Entity\GH;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GH>
 *
 * @method GH|null find($id, $lockMode = null, $lockVersion = null)
 * @method GH|null findOneBy(array $criteria, array $orderBy = null)
 * @method GH[]    findAll()
 * @method GH[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GHRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GH::class);
    }

//    /**
//     * @return GH[] Returns an array of GH objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GH
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
