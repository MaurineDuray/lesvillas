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

    public function findByCriteria(string $criteria)
    {
       $qb = $this->createQueryBuilder('i');
       $qb
           ->where(
               $qb->expr()->andX(
                   $qb->expr()->orX(
                       $qb->expr()->like('i.Titre', ':criteria'),
                       $qb->expr()->like('i.TitreEn', ':criteria'),
                       $qb->expr()->like('i.TitreEs', ':criteria'),
                       $qb->expr()->like('i.description', ':criteria'),
                       $qb->expr()->like('i.descriptionEn', ':criteria'),
                       $qb->expr()->like('i.descriptionEs', ':criteria'),
                       $qb->expr()->like('i.type', ':criteria'),
                       $qb->expr()->like('i.typeEn', ':criteria'),
                       $qb->expr()->like('i.address', ':criteria')
                   ),
               )
           )
           ->setParameter('criteria', '%' . $criteria . '%');
       return $qb
           ->getQuery()
           ->getResult();
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
    
   
  public function findByFilter(string $conciergerie, string $type, int $travellers, int $rooms): array
  {
      return $this->createQueryBuilder('i')
          ->select('i as immos, i.slug, i.bathrooms, i.bedrooms, i.calendrier, i.conciergerie, i.cover, i.description, i.descriptionEn, i.equipement, i.equipementEn, i.logement, i.logementEn, i.price, i.priceEn, i.titre, i.titreEn, i.travellers, i.type')
          ->groupBy('i.id') // Je suppose que vous voulez grouper par l'ID
          ->orderBy('i.id', 'DESC')
          ->where('i.travellers = :travellers')
          ->andWhere('i.bedrooms = :rooms') // Utilisez "=" pour la comparaison
          ->andWhere('i.conciergerie = :conciergerie')
          ->andWhere('i.type = :type')
          ->andWhere('i.typeEn = :type')
          ->setParameters([
              'travellers' => $travellers,
              'rooms' => $rooms, // Utilisez la même clé 'rooms' ici
              'type' => $type, // Utilisez la même clé 'housetype' ici
              'conciergerie' => $conciergerie
          ])
          ->getQuery()
          ->getResult();
  }

       public function findById($value): ?Immos
   {
       return $this->createQueryBuilder('i')
           ->andWhere('i.id = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
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


