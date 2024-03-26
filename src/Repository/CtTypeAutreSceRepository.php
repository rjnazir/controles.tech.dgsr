<?php

namespace App\Repository;

use App\Entity\CtTypeAutreSce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CtTypeAutreSce>
 *
 * @method CtTypeAutreSce|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtTypeAutreSce|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtTypeAutreSce[]    findAll()
 * @method CtTypeAutreSce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtTypeAutreSceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtTypeAutreSce::class);
    }

    public function add(CtTypeAutreSce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CtTypeAutreSce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CtTypeAutreSce[] Returns an array of CtTypeAutreSce objects
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

//    public function findOneBySomeField($value): ?CtTypeAutreSce
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
