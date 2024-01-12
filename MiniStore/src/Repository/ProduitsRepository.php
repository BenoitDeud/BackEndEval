<?php

namespace App\Repository;

use App\Entity\Produits;
use App\Entity\Categories;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Produits>
 *
 * @method Produits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produits[]    findAll()
 * @method Produits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    public function findByCategories($categories)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.categories', 'c')
            ->andWhere('c.nom = :categories')
            ->setParameter('categories', $categories->getNom())
            ->getQuery()
            ->getResult();
    }
    
    public function findByCategoriesAndName($categories, $nom)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.categories', 'c')
            ->andWhere('c.nom = :categories')
            ->andWhere('p.nom LIKE :nom')
            ->setParameter('categories', $categories->getNom())
            ->setParameter('nom', '%'.$nom.'%')
            ->getQuery()
            ->getResult();
    }
    public function findByName($nom)
{
    return $this->createQueryBuilder('p')
        ->andWhere('p.nom LIKE :nom')
        ->setParameter('nom', '%'.$nom.'%')
        ->getQuery()
        ->getResult();
}

//    /**
//     * @return Produits[] Returns an array of Produits objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Produits
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
