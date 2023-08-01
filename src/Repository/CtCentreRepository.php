<?php

namespace App\Repository;

use App\Entity\CtCentre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CtCentre>
 *
 * @method CtCentre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtCentre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtCentre[]    findAll()
 * @method CtCentre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtCentreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtCentre::class);
    }

    public function add(CtCentre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CtCentre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * Fonction permettant de mofidier l'affichage du nom du centre
     * suivant le nom de centre entré comme parametre
     * @param string $ctrNom : Nom centre à traiter
     * @return array $center : Nom centre à traiter et lieu
     */
    public function transformCenter(string $ctrNom)
    {
        $centre = array();
        switch($ctrNom){
            case "ALAROBIA"         : $centre = array('LE COLONEL,<w:br/>directeur des opérations routières','VISITE A DOMICILE : '.$ctrNom, '', 'ALR', 'N°    -DGSR/DOR/'.date('y')); break;

            case "ALASORA"          : $centre = array('Le chef de centre de la sécurité routière', 'ALASORA', 'Centre de la sécurité routière', 'ALS', 'N°    -CENSERO/ALS/'.date('y')); break;
            case "ANTSIRABE"        : $centre = array('Le chef de centre de la sécurité routière', 'ANTSIRABE', 'Centre de la sécurité routière', 'ABE', 'N°    -CENSERO/ABE/'.date('y')); break;
            case "BETONGOLO"        : $centre = array('Le chef de centre de la sécurité routière', 'BETONGOLO', 'Centre de la sécurité routière', 'BGL', 'N°        -CENSERO/BGL/'.date('y')); break;
            case "IVATO"            : $centre = array('Le chef de centre de la sécurité routière', 'IVATO', 'Centre de la sécurité routière', 'IVT', 'N°    -CENSERO/IVT/'.date('y')); break;
            case "TSIROANOMANDIDY"  : $centre = array('Le chef de centre de la sécurité routière', 'TSIROANOMANDIDY', 'Centre de la sécurité routière', 'TDD', 'N°    -CENSERO/TDD/'.date('y')); break;
            
            case "AMBATONDRAZAKA"   : $centre = array('Le chef de centre de la sécurité routière', 'AMBATONDRAZAKA', 'Centre de la sécurité routière', 'AKA', 'N°    -CENSERO/AKA/'.date('y')); break;
            case "FENERIVE-EST"     : $centre = array('Le chef de centre de la sécurité routière', 'FENERIVE-EST', 'Centre de la sécurité routière', 'FVE', 'N°    -CENSERO/FVE/'.date('y')); break;
            case "MORAMANGA"        : $centre = array('Le chef de centre de la sécurité routière', 'MORAMANGA', 'Centre de la sécurité routière', 'MOG', 'N°    -CENSERO/MOG/'.date('y')); break;
            case "TANAMBOROZANO"    : $centre = array('Le chef de centre de la sécurité routière', 'TOAMASINA', 'Centre de la sécurité routière', 'TNA', 'N°    -CENSERO/TNA/'.date('y')); break;
            case "BARIKADIMY"       : $centre = array('Le chef de centre de la sécurité routière', 'TOAMASINA', 'Centre de la sécurité routière', 'TNA (A)', 'N°    -CENSERO/TNA/'.date('y')); break;

            case "AMBOSITRA"        : $centre = array('Le chef de centre de la sécurité routière', 'AMBOSITRA', 'Centre de la sécurité routière', 'ATR', 'N°    -CENSERO/ATR/'.date('y')); break;
            case "FARAFANGANA"      : $centre = array('Le chef de centre de la sécurité routière', 'FARAFANGANA', 'Centre de la sécurité routière', 'FNA', 'N°    -CENSERO/FNA/'.date('y')); break;
            case "BESOROHITRA"      : $centre = array('Le chef de centre de la sécurité routière', 'FIANARANTSOA', 'Centre de la sécurité routière', 'FNR', 'N°    -CENSERO/FNR/'.date('y')); break;
            case "MANAKARA"         : $centre = array('Le chef de centre de la sécurité routière', 'MANAKARA', 'Centre de la sécurité routière', 'MRA', 'N°    -CENSERO/MRA/'.date('y')); break;

            case "TRANOBOZAKA"      : $centre = array('Le chef de centre de la sécurité routière', 'ANTSIRANANA', 'Centre de la sécurité routière', 'ANA', 'N°    -CENSERO/ANA/'.date('y')); break;
            case "NOSY BE"          : $centre = array('Le chef de centre de la sécurité routière', 'NOSY BE', 'Centre de la sécurité routière', 'NSB', 'N°    -CENSERO/NSB/'.date('y')); break;
            case "SAMBAVA"          : $centre = array('Le chef de centre de la sécurité routière', 'SAMBAVA', 'Centre de la sécurité routière', 'SVA', 'N°    -CENSERO/SVA/'.date('y')); break;

            case "ANTSOHIHY"        : $centre = array('Le chef de centre de la sécurité routière', 'ANTSOHIHY', 'Centre de la sécurité routière', 'ATH', 'N°    -CENSERO/ATH/'.date('y')); break;
            case "AMBOROVY"         : $centre = array('Le chef de centre de la sécurité routière', 'MAHANJANGA', 'Centre de la sécurité routière', 'MGA', 'N°    -CENSERO/MGA/'.date('y')); break;

            case "AMBOVOMBE"        : $centre = array('Le chef de centre de la sécurité routière', 'AMBOVOMBE', 'Centre de la sécurité routière', 'ABA', 'N°    -CENSERO/ABA/'.date('y')); break;
            case "IHOSY"            : $centre = array('Le chef de centre de la sécurité routière', 'IHOSY', 'Centre de la sécurité routière', 'IHO', 'N°    -CENSERO/IHO/'.date('y')); break;
            case "MORONDAVA"        : $centre = array('Le chef de centre de la sécurité routière', 'MORONDAVA', 'Centre de la sécurité routière', 'MVA', 'N°    -CENSERO/MVA/'.date('y')); break;
            case "SANFIL"           : $centre = array('Le chef de centre de la sécurité routière', 'TOLIARA', 'Centre de la sécurité routière', 'TLR', 'N°    -CENSERO/TLR/'.date('y')); break;
            case "TAOLAGNARO"       : $centre = array('Le chef de centre de la sécurité routière', 'TAOLAGNARO', 'Centre de la sécurité routière', 'TRO', 'N°    -CENSERO/TRO/'.date('y')); break;

            case "CENTRE_RECEPTION_TECHNIQUE" :
            case "CENTRE RECEPTION TECHNIQUE"
                                    : $centre = array('Le chef centre de réception technique', 'ALASORA', 'Centre de réception technique', 'CRT', 'N°    -CRT/'.date('y')); break;
            case (preg_match('/RECEPTION/i', $ctrNom) ? true : false)
                                    : $centre = array('Le chef centre de réception technique', 'ALASORA<w:br/>('.str_replace('RECEPTION TECHNIQUE ', '', str_replace('_',' ',$ctrNom).')'), 'Centre de réception technique', 'CRT', 'N°    -CRT/'.date('y')); break;

            default                 : $centre = array('Le chef de centre de la sécurité routière', $ctrNom, 'Centre de la sécurité routière', 'CSR', 'N°    -CENSERO/CSR/'.date('y'));
        }
        return $centre;
    }

    /**
    *	Fonction permettant de tester si l'user peut acceder à la page actuelle
    */
    function dateLetterFr()
    {
        $months = ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"];
        $day = date('d');
        $year = date('Y');
        $month = date('m');
        $mois = $months[$month-1];
        $_date = $day.' '.$mois.' '.$year;
        return $_date;
    }
//    /**
//     * @return CtCentre[] Returns an array of CtCentre objects
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

//    public function findOneBySomeField($value): ?CtCentre
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
