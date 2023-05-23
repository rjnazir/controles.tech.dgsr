<?php

namespace App\Repository;

use App\Entity\CtExpressionBesoin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CtExpressionBesoin>
 *
 * @method CtExpressionBesoin|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtExpressionBesoin|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtExpressionBesoin[]    findAll()
 * @method CtExpressionBesoin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtExpressionBesoinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtExpressionBesoin::class);
    }

    public function add(CtExpressionBesoin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CtExpressionBesoin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CtExpressionBesoin[] Returns an array of CtExpressionBesoin objects
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

//    public function findOneBySomeField($value): ?CtExpressionBesoin
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
