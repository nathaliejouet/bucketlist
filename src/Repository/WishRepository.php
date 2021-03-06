<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wish[]    findAll()
 * @method Wish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }

    public function wish_list()
    {
        return new Paginator($this->createQueryBuilder('w')
            ->join('w.category', 'cat')
            ->addSelect('cat')
            ->addOrderBy('w.dateCreated', 'DESC')
            ->getQuery());
    }

    public function wish_by_id($id): ?Wish
    {
        return $this->find($id);
    }

    public function findIdea($name): array
    {
        $queryBuilder = $this->createQueryBuilder('w')
            ->andWhere('w.title LIKE :name')
            ->setParameter(':name', "%" . $name . "%");

        return $queryBuilder->getQuery()->getResult();

    }

    // /**
    //  * @return Wish[] Returns an array of Wish objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wish
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
