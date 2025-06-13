<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

       /**
         *@return Recipe[] Returns an array of Recipe objects
         *cette methode permet de recuperer toutes les recettes qui ont une duree inferieure ou egale a la duree passee en parametre
         */
      
       public function findRecipeDurationLowerThan(int $duration): array
       {
           return $this->createQueryBuilder('r')/* esse methodo vem do ServiceEntityRepository herda da classe pais*/ 
               ->andWhere('r.duration <= :duration')
               ->setParameter('duration', $duration)
               ->orderBy('r.duration', 'ASC')
               ->getQuery()
               ->getResult()
               
           ;
       }

    //    public function findOneBySomeField($value): ?Recipe
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
  
}
