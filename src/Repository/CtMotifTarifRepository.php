<?php

namespace App\Repository;

use App\Entity\CtMotifTarif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @extends ServiceEntityRepository<CtMotifTarif>
 *
 * @method CtMotifTarif|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtMotifTarif|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtMotifTarif[]    findAll()
 * @method CtMotifTarif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtMotifTarifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtMotifTarif::class);
    }

    public function add(CtMotifTarif $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CtMotifTarif $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return CtMotifTarif[] Returns an array of CtMotifTarif objects
    */
    public function countByArreteMotifDate($ctArretePrix, $ctMotif, $mtfTrfDate): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.ctArretePrix = :arrete_id')
            ->setParameter('arrete_id', $ctArretePrix)
            ->andWhere('c.ctMotif = :motif_id')
            ->setParameter('motif_id', $ctMotif)
            ->andWhere('c.mtfTrfDate = :mtfTrfDate')
            ->setParameter('mtfTrfDate', $mtfTrfDate)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
       ;
    }

//    /**
//     * @return CtMotifTarif[] Returns an array of CtMotifTarif objects
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

//    public function findOneBySomeField($value): ?CtMotifTarif
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
