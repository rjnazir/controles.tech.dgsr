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

    public function findNumberEDB($centre, $dedition): string
    {
        $list = $this->createQueryBuilder('c')
            ->andWhere('c.ctCentre = ?1 ')
            ->andWhere('c.edbDateEdit = ?2 ')
            ->setParameter(1, $centre)
            ->setParameter(2, $dedition)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
        foreach($list as $list){
            $numero = $list->getEdbNumero();
        }
        return $numero;
    }

    public function getDirGeneratedPdf($type){
        if(strtoupper(substr(PHP_OS, 0, 3)) === "WIN"){
            switch($type){
                case 'edb'  : $_dir_generated = "E:\\laragon\\www\\controles.tech.dgsr\\public\\reporting\\generated\\edb\\";break;
                default     : $_dir_generated = "E:\\laragon\\www\\controles.tech.dgsr\\public\\reporting\\generated\\";break;
            }
        }else{
            switch($type){
                case 'edb'  : $_dir_generated = "/var/www/html/controles.tech.dgsr/public/reporting/generated/edb/";break;
                default     : $_dir_generated = "/var/www/html/controles.tech.dgsr/public/reporting/generated/";break;
            }
        }
        return $_dir_generated;
    }

    /* public function findWithCtImprime($centre, $dedition)
    {
//        return $this->createQueryBuilder('c')
//            ->innerJoin('c.ctContenu_ct_expression_besoin', 'ctImprimeTech')
//            ->innerJoin('c.ctImprimeTech', 'ctImprimeTech')
//            ->addSelect('ctImprimeTech')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()

    } */

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
