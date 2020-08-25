<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    /**
     * @return Recipe[]
     */
    public function findAll(): array
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }

    /**
     * @return Recipe[]
     */
    public function searchFor(string $query): array {
        // automatically knows to select Recipes
        // the "r" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('r')
            ->where('r.title LIKE :wildcard')
            ->orWhere('r.category LIKE :wildcard')
            ->orWhere('r.description LIKE :wildcard')
            ->orWhere('r.ingredients LIKE :wildcard')
            ->setParameter('wildcard', '%'.$query.'%')
            ->orderBy('r.id', 'DESC');

        // if (!$includeUnavailableProducts) {
        //     $qb->andWhere('p.available = TRUE')
        // }

        $query = $qb->getQuery();

        return $query->execute();
    }

    // /**
    //  * @return Recipe[] Returns an array of Recipe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recipe
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
