<?php

namespace App\Repository;

use App\Entity\CtContenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CtContenu>
 *
 * @method CtContenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtContenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtContenu[]    findAll()
 * @method CtContenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtContenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtContenu::class);
    }

    public function add(CtContenu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CtContenu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function contenuWithCentreDate($ctCentre, $edbDateEdit): array
    {
        return $this->createQueryBuilder('c')
            ->addSelect('ctExpressionBesoin')
            ->join('c.ctExpressionBesoin', 'ctExpressionBesoin')

            ->andWhere('ctExpressionBesoin.ctCentre = :ctCentre')
            ->setParameter('ctCentre', $ctCentre)
            ->andWhere('ctExpressionBesoin.edbDateEdit = :edbDateEdit')
            ->setParameter('edbDateEdit', $edbDateEdit)

            ->addOrderBy('c.id', 'DESC')

            ->getQuery()
            ->getResult();
    }

    public function updateCtContenuForDropBordereau($ctBordereau)
    {
        $qb = $this->createQueryBuilder('q');
        $qb->update(CtContenu::class, 'c');
        $qb->set('c.debutNumero', "NULL");
        $qb->set('c.finNumero', "NULL");
        $qb->set('c.ctBordereau', "NULL");
        $qb->where($qb->expr()->in('c.ctBordereau', $ctBordereau));
        return $qb->getQuery()->execute();
    }

    public function deleteContenu($ctExpressionBesoin)
    {
        $qb = $this->createQueryBuilder('q');
        $qb->delete(CtContenu::class, 'c');
        $qb->where($qb->expr()->in('c.ctExpressionBesoin', $ctExpressionBesoin));
        return $qb->getQuery()->execute();
    }

//    /**
//     * @return CtContenu[] Returns an array of CtContenu objects
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

//    public function findOneBySomeField($value): ?CtContenu
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
