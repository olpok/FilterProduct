<?php

namespace App\Repository;

use App\Entity\Product;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Product::class);
        $this->paginator = $paginator;
    }

    /**
     * Recupère les produits en lien avec une recherche
     * @return PaginationInterface
     */
    public function findSearch(SearchData $search):PaginationInterface
    {
            $query = $this
                ->createQueryBuilder('p')
                ->select('c', 'p')
                ->join('p.categories', 'c');

            if(!empty($search->q)){
            $query = $query
                ->andWhere('p.name LIKE :q')
                ->setParameter('q', "%{$search->q}%");
            }

            if(!empty($search->min)){
            $query = $query
                ->andWhere('p.price >= :min')
                ->setParameter('min', $search->min);
            }

            if(!empty($search->max)){
            $query = $query
                ->andWhere('p.price <= :max')
                ->setParameter('max', $search->max);
            }

            if(!empty($search->promo)){
            $query = $query
                ->andWhere('p.promo = 1');
            }

            if(!empty($search->categories)){
            $query = $query
                ->andWhere('c.id IN ( :categories)')
                ->setParameter('categories', $search->categories);
            }
            
            $query = $query->getQuery();
                return $this->paginator->paginate(
                    $query,
                    $search->page,
                    9
                );

        //    return $query->getQuery()->getResult();
  
            //     return $this->findAll();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
