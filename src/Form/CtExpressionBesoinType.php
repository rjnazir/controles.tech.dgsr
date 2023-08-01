<?php

namespace App\Form;

use App\Form\CtContenuType;
use App\Entity\CtCentre;
use App\Entity\CtExpressionBesoin;
use App\Entity\CtImprimeTech;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class CtExpressionBesoinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $ctCentre = $options['ctCentre'];

        $builder
            ->add('ctCentre', EntityType::class, [
                'label' => 'Votre centre',
                'class' => CtCentre::class,
                'choice_label' => 'ctrNom',
                'required'   => true,
                'query_builder' => function (EntityRepository $_er) use ($ctCentre) {
                    if($ctCentre){
                        return $_er
                            ->createQueryBuilder('c')
                            ->where("c.isParent = 1")
                            ->Where("c.id = ".$ctCentre."")
                            ->orderBy('c.ctr_nom', 'ASC');
                    }else{
                        return $_er
                            ->createQueryBuilder('c')
                            ->where("c.isParent = 1")
                            ->orderBy('c.ctr_nom', 'ASC');
                    }
                },
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
            ])
            ->add('edbNumero', TextType::class, [
                'label' => 'Numéro de l\'EDB',
                'required'   => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm',
                ]
            ])
            ->add('edbDateEdit', null, [
                'label' => 'Date de l\'EDB',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'datetimepicker form-control form-control-sm',
                ],
                'required' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr'  => [
                    'class' => 'col-2 btn btn-sm btn-success',
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CtExpressionBesoin::class,
        ]);

        $resolver->setRequired([
            'ctCentre',
        ]);
    }
}

class ContenuType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('ctImprimeTech', EntityType::class, [
                'label' => 'Type d\'imprimé',
                'class' => CtImprimeTech::class,
                'choice_label' => 'nomImprimeTech',
                'required'   => false,
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
            ])
            ->add('qteDemande', NumberType::class, [
                'label' => 'Quantité',
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
        ;
    }
}
