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

            case "ALASORA"          : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'ALASORA', 'CENTRE DE LA SECURITE ROUTIERE', 'ALS', 'N°    -CENSERO/ALS/'.date('y')); break;
            case "ANTSIRABE"        : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'ANTSIRABE', 'CENTRE DE LA SECURITE ROUTIERE', 'ABE', 'N°    -CENSERO/ABE/'.date('y')); break;
            case "BETONGOLO"        : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'BETONGOLO', 'CENTRE DE LA SECURITE ROUTIERE', 'BGL', 'N°        -CENSERO/BGL/'.date('y')); break;
            case "IVATO"            : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'IVATO', 'CENTRE DE LA SECURITE ROUTIERE', 'IVT', 'N°    -CENSERO/IVT/'.date('y')); break;
            case "TSIROANOMANDIDY"  : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'TSIROANOMANDIDY', 'CENTRE DE LA SECURITE ROUTIERE', 'TDD', 'N°    -CENSERO/TDD/'.date('y')); break;
            
            case "AMBATONDRAZAKA"   : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'AMBATONDRAZAKA', 'CENTRE DE LA SECURITE ROUTIERE', 'AKA', 'N°    -CENSERO/AKA/'.date('y')); break;
            case "FENERIVE-EST"     : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'FENERIVE-EST', 'CENTRE DE LA SECURITE ROUTIERE', 'FVE', 'N°    -CENSERO/FVE/'.date('y')); break;
            case "MORAMANGA"        : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'MORAMANGA', 'CENTRE DE LA SECURITE ROUTIERE', 'MOG', 'N°    -CENSERO/MOG/'.date('y')); break;
            case "TANAMBOROZANO"    : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'TOAMASINA', 'CENTRE DE LA SECURITE ROUTIERE', 'TNA', 'N°    -CENSERO/TNA/'.date('y')); break;
            case "BARIKADIMY"       : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'TOAMASINA', 'CENTRE DE LA SECURITE ROUTIERE', 'TNA (A)', 'N°    -CENSERO/TNA/'.date('y')); break;

            case "AMBOSITRA"        : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'AMBOSITRA', 'CENTRE DE LA SECURITE ROUTIERE', 'ATR', 'N°    -CENSERO/ATR/'.date('y')); break;
            case "FARAFANGANA"      : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'FARAFANGANA', 'CENTRE DE LA SECURITE ROUTIERE', 'FNA', 'N°    -CENSERO/FNA/'.date('y')); break;
            case "BESOROHITRA"      : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'FIANARANTSOA', 'CENTRE DE LA SECURITE ROUTIERE', 'FNR', 'N°    -CENSERO/FNR/'.date('y')); break;
            case "MANAKARA"         : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'MANAKARA', 'CENTRE DE LA SECURITE ROUTIERE', 'MRA', 'N°    -CENSERO/MRA/'.date('y')); break;

            case "TRANOBOZAKA"      : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'ANTSIRANANA', 'CENTRE DE LA SECURITE ROUTIERE', 'ANA', 'N°    -CENSERO/ANA/'.date('y')); break;
            case "NOSY BE"          : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'NOSY BE', 'CENTRE DE LA SECURITE ROUTIERE', 'NSB', 'N°    -CENSERO/NSB/'.date('y')); break;
            case "SAMBAVA"          : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'SAMBAVA', 'CENTRE DE LA SECURITE ROUTIERE', 'SVA', 'N°    -CENSERO/SVA/'.date('y')); break;

            case "ANTSOHIHY"        : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'ANTSOHIHY', 'CENTRE DE LA SECURITE ROUTIERE', 'ATH', 'N°    -CENSERO/ATH/'.date('y')); break;
            case "AMBOROVY"         : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'MAHANJANGA', 'CENTRE DE LA SECURITE ROUTIERE', 'MGA', 'N°    -CENSERO/MGA/'.date('y')); break;

            case "AMBOVOMBE"        : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'AMBOVOMBE', 'CENTRE DE LA SECURITE ROUTIERE', 'ABA', 'N°    -CENSERO/ABA/'.date('y')); break;
            case "IHOSY"            : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'IHOSY', 'CENTRE DE LA SECURITE ROUTIERE', 'IHO', 'N°    -CENSERO/IHO/'.date('y')); break;
            case "MORONDAVA"        : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'MORONDAVA', 'CENTRE DE LA SECURITE ROUTIERE', 'MVA', 'N°    -CENSERO/MVA/'.date('y')); break;
            case "SANFIL"           : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'TOLIARA', 'CENTRE DE LA SECURITE ROUTIERE', 'TLR', 'N°    -CENSERO/TLR/'.date('y')); break;
            case "TAOLAGNARO"       : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', 'TAOLAGNARO', 'CENTRE DE LA SECURITE ROUTIERE', 'TRO', 'N°    -CENSERO/TRO/'.date('y')); break;

            case "CENTRE_RECEPTION_TECHNIQUE"
                                    : $centre = array('LE CHEF DE CENTRE DE RECEPTION TECHNIQUE', 'ALASORA', 'CENTRE DE RECEPTION TECHNIQUE', 'CRT', 'N°    -CRT/'.date('y')); break;
            case (preg_match('/RECEPTION/i', $ctrNom) ? true : false)
                                    : $centre = array('LE CHEF DE CENTRE DE RECEPTION TECHNIQUE', 'ALASORA<w:br/>('.str_replace('RECEPTION TECHNIQUE ', '', str_replace('_',' ',$ctrNom).')'), 'CENTRE DE RECEPTION TECHNIQUE', 'CRT', 'N°    -CRT/'.date('y')); break;

            default                 : $centre = array('LE CHEF DE CENTRE DE LA SECURITE ROUTIERE', $ctrNom, 'CENTRE DE LA SECURITE ROUTIERE', 'CSR', 'N°    -CENSERO/CSR/'.date('y'));
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
        $_date = $day.' '.strtolower($mois).' '.$year;
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
