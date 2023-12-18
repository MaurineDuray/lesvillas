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

    public function findByConciergerie($value): array
   {
       return $this->createQueryBuilder('i')
           ->andWhere('i.conciergerie = :val')
           ->setParameter('val', $value)
           ->orderBy('i.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

   public function findByTopAzur($value): array
   {
       return $this->createQueryBuilder('i')
           ->andWhere('i.conciergerie = :val')
           ->setParameter('val', $value)
           ->orderBy('i.id', 'DESC')
           ->setMaxResults(3)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findByTopFloride($value): array
   {
       return $this->createQueryBuilder('i')
           ->andWhere('i.conciergerie = :val')
           ->setParameter('val', $value)
           ->orderBy('i.id', 'DESC')
           ->setMaxResults(3)
           ->getQuery()
           ->getResult()
       ;
   }
    
   /**
     * Recherche des motifs par filtre
    * @return Immos[] Returns an array of Pattern objects
    */
    public function findByFilter(string $housetype, int $travellers, int $rooms, int $price): array
    {
       return $this->createQueryBuilder('i')
           ->select('i as immos, i.slug, i.bathrooms, i.bedrooms, i.calendrier, i.conciergerie, i.cover, i.description, i.descriptionEn, i.equipement, i.equipementEn, i.logement, i.logementEn, i.price, i.priceEn, i.titre, i.titreEn, i.travellers, i.type')
           ->groupBy('i')
           ->orderBy('i.id', 'DESC')
           ->where('i.travellers= :travellers')
           ->andWhere('i.bedrooms: :rooms')
           ->andwhere('i.price= :price')
           ->andWhere()('i.type= :housetype')
           ->setParameters([
            'travellers'=> $travellers,
            'bedrooms' => $rooms,
            'price' => $price,
            'type'=>$housetype
           ])
           ->getQuery()
           ->getResult()
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

