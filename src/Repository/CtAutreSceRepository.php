<?php

namespace App\Repository;

use App\Entity\CtAutreSce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CtAutreSce>
 *
 * @method CtAutreSce|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtAutreSce|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtAutreSce[]    findAll()
 * @method CtAutreSce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtAutreSceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtAutreSce::class);
    }

    public function add(CtAutreSce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CtAutreSce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CtAutreSce[] Returns an array of CtAutreSce objects
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

//    public function findOneBySomeField($value): ?CtAutreSce
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
