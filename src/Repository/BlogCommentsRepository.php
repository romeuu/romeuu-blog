<?php

namespace App\Repository;

use App\Entity\BlogComments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BlogComments|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogComments|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogComments[]    findAll()
 * @method BlogComments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogCommentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogComments::class);
    }

    // /**
    //  * @return BlogComments[] Returns an array of BlogComments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlogComments
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
