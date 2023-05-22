<?php

namespace App\Repository;

use App\Entity\CtZoneDeserte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CtZoneDeserte>
 *
 * @method CtZoneDeserte|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtZoneDeserte|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtZoneDeserte[]    findAll()
 * @method CtZoneDeserte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtZoneDeserteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtZoneDeserte::class);
    }

    public function add(CtZoneDeserte $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CtZoneDeserte $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CtZoneDeserte[] Returns an array of CtZoneDeserte objects
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

//    public function findOneBySomeField($value): ?CtZoneDeserte
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
