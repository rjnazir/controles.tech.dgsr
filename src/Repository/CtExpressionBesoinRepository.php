<?php

namespace App\Repository;

use App\Entity\CtExpressionBesoin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

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

    /* public function generateEdb($centre, $dedition)
    {
        $this->findBy(['ctCentre'=>$centre, 'edbDateEdit'=>$dedition]);
        $template_src = new TemplateProcessor('reporting/templates/edb/edb.docx');

        $dirgenerated = 'reporting/generated/edb/';
        $filename = 'edb'.$centre.'_'.date('Ymdhis').'.docx';

        $php_word = new PhpWord();
        $template = $php_word->loadTemplate($template_src);

        $template->setValue('bl_numero', $dedition);

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
