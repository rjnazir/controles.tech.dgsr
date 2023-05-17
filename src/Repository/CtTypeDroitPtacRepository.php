<?php

namespace App\Repository;

use App\Entity\CtTypeDroitPtac;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CtTypeDroitPtac>
 *
 * @method CtTypeDroitPtac|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtTypeDroitPtac|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtTypeDroitPtac[]    findAll()
 * @method CtTypeDroitPtac[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtTypeDroitPtacRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtTypeDroitPtac::class);
    }

    public function add(CtTypeDroitPtac $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CtTypeDroitPtac $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CtTypeDroitPtac[] Returns an array of CtTypeDroitPtac objects
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

//    public function findOneBySomeField($value): ?CtTypeDroitPtac
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
