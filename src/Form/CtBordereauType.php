<?php

namespace App\Form;

use App\Entity\CtCentre;
use App\Entity\CtBordereau;
use App\Entity\CtImprimeTech;
use App\Entity\CtExpressionBesoin;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CtBordereauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $idCentre = $options['idCentre'];

        $builder
            ->add('ctCentre', EntityType::class, [
                'label' => 'Centre destinataire',
                'class' => CtCentre::class,
                'choice_label' => 'ctr_nom',
                'required'   => true,
                'query_builder' => function (EntityRepository $_er) use ($idCentre) {
                    if($idCentre == 26){
                        return $_er
                            ->createQueryBuilder('c')
                            ->where("c.isParent = 1")
                            ->where("c.id IN (7, 9, 10, 11, 22)")
                            ->orderBy('c.ctr_nom', 'ASC');
                    }else{
                        return $_er
                            ->createQueryBuilder('c')
                            ->where("c.isParent = 1 ")
                            ->orderBy('c.ctr_nom', 'ASC');
                    }
                },
                'group_by'     => function (CtCentre $_centre) {
                    if ($_centre->getCtProvince())
                        return $_centre->getCtProvince()->getPrvNom();
                },
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
            ])
            ->add('ctExpressionBesoin', EntityType::class, [
                'label' => 'Réf. expression de besoin',
                'class' => CtExpressionBesoin::class,
                'query_builder' => function (EntityRepository $_er) {
                    return $_er
                        ->createQueryBuilder('edb')
                        ->orderBy('edb.id', 'DESC');
                }, 
                'choice_label' => 'edbNumero',
                'required'   => false,
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
            ])
            ->add('beNumero', TextType::class, [
                'label' => 'Numéro du BE',
                'required'   => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm',
                ]
            ])
            ->add('beDateEdit', null, [
                'label' => 'Date du BE',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control form-control-sm datetimepicker',
                ],
                'required' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr'  => [
                    'class' => 'col-2 btn btn-sm bg-gradient-success text-white',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CtBordereau::class,
        ]);

        $resolver->setRequired([
            'idCentre'
        ]);   
    }
}
