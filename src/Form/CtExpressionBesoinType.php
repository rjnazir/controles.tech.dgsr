<?php

namespace App\Form;

use App\Entity\CtCentre;
use App\Entity\CtExpressionBesoin;
use App\Entity\CtImprimeTech;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtExpressionBesoinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // $ctCentre = $options['ctCentre'];

        $builder
            ->add('ctCentre', EntityType::class, [
                'label' => 'Votre centre',
                'class' => CtCentre::class,
                'choice_label' => 'ctrNom',
                'disabled' => true,
                'data' => $options['ctCentre'],
            ])
            ->add('ctImprimeTech', EntityType::class, [
                'label' => 'Type d\'imprimé',
                'class' => CtImprimeTech::class,
                'choice_label' => 'nomImprimeTech',
                'required'   => false,
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
            ])
            ->add('edbNumero', IntegerType::class, [
                'label' => 'Numéro de l\'EDB',
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('edbDateEdit', null, [
                'label' => 'Date de l\'arrêté',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'datetimepicker',
                ],
                'required' => true,
            ])
            ->add('edbQteDemander', NumberType::class, [
                'label' => 'Quantité',
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr'  => [
                    'class' => 'col-2 btn btn-sm btn-success',
                ]
            ])
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
