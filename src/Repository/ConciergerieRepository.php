<?php

namespace App\Repository;

use App\Entity\Conciergerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Conciergerie>
 *
 * @method Conciergerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conciergerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conciergerie[]    findAll()
 * @method Conciergerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConciergerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conciergerie::class);
    }

//    /**
//     * @return Conciergerie[] Returns an array of Conciergerie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Conciergerie
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
