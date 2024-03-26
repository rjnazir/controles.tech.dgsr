<?php

namespace App\Repository;

use App\Entity\CtTarifAutreSce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CtTarifAutreSce>
 *
 * @method CtTarifAutreSce|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtTarifAutreSce|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtTarifAutreSce[]    findAll()
 * @method CtTarifAutreSce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtTarifAutreSceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtTarifAutreSce::class);
    }

    public function add(CtTarifAutreSce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CtTarifAutreSce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CtTarifAutreSce[] Returns an array of CtTarifAutreSce objects
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

//    public function findOneBySomeField($value): ?CtTarifAutreSce
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
