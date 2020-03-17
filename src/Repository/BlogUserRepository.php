<?php

namespace App\Repository;

use App\Entity\BlogUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BlogUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogUser[]    findAll()
 * @method BlogUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogUser::class);
    }

    // /**
    //  * @return BlogUser[] Returns an array of BlogUser objects
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
    public function findOneBySomeField($value): ?BlogUser
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
