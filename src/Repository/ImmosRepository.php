<?php

namespace App\Repository;

use App\Entity\Immos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Immos>
 *
 * @method Immos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Immos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Immos[]    findAll()
 * @method Immos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImmosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Immos::class);
    }


    public function findByLocal($value): ?Immos
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.conciergerie = :val')
            ->setParameter('val', $value)
            ->getQuery()
            
        ;
    }


//    /**
//     * @return Immos[] Returns an array of Immos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Immos
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}


