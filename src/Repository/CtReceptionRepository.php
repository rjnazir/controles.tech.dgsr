<?php

namespace App\Repository;

use App\Entity\CtReception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CtReception>
 *
 * @method CtReception|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtReception|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtReception[]    findAll()
 * @method CtReception[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtReceptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtReception::class);
    }

    public function add(CtReception $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CtReception $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return CtReception[] Returns an array of CtReception objects
    */
    public function findByDayNotDeleted($date): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.rcpCreated LIKE :date')
            ->andWhere('c.isDeleted = :vide')
            ->setParameter('date', $date.'%')
            ->setParameter('vide', 'NULL')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return CtReception[] Returns an array of CtReception objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CtReception
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
