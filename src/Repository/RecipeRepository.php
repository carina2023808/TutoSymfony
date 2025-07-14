<?php

namespace App\Repository;

use App\Entity\Recipe;
use App\Model\SearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginatorInterface)
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

       public function findBySeach(SearchData $searchData): PaginationInterface
       {

        $data =$this->createQueryBuilder('r')
        ->addOrderBy('r.createdAt', 'DESC');

        if (!empty($searchData->q))
            {
            $data = $data
                ->andWhere('r.title LIKE :q')
               ->setParameter('q', "%{$searchData->q}%");

        }

        $data= $data
        ->getQuery()
        ->getResult();

        $recipes= $this->paginatorInterface->paginate($data, $searchData->page,9);

          return $recipes;
              
       }
  
}
