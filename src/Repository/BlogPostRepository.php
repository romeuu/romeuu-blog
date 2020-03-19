<?php

namespace App\Repository;

use App\Entity\BlogPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use \PDO;

/**
 * @method BlogPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPost[]    findAll()
 * @method BlogPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }

    // /**
    //  * @return BlogPost[] Returns an array of BlogPost objects
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
    public function findOneBySomeField($value): ?BlogPost
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllByTitle($title): array
    {
        // ---------------- DQL ----------------
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
        SELECT * FROM blog_post p WHERE p.title LIKE '%".$title."%'
        ";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['title' => $title]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

    public function findAll(): array
    {
        // ---------------- DQL ----------------
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
        SELECT * FROM blog_post
        ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function findPost($id){
        // ---------------- DQL ----------------
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
        SELECT * FROM blog_post p where p.id LIKE $id
        ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function updatePost($id, $obj){
        // ---------------- DQL ----------------
        $conn = $this->getEntityManager()->getConnection();

        $titulo = $obj->getTitle();
        $slug = $obj->getSlug();
        $description = $obj->getDescription();

        $sql = "
        UPDATE blog_post p
        SET title = '$titulo', slug = '$slug', description = '$description'
        WHERE id LIKE $id; 
        ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}
