<?php

namespace App\Form;

use App\Entity\CtArretePrix;
use App\Entity\CtTypeVisite;
use App\Entity\CtUsage;
use App\Entity\CtUsageTarif;
use App\Repository\CtArretePrixRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtUsageTarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ctArretePrix', EntityType::class, [
                'label' => 'Arrêté',
                'class' => CtArretePrix::class,
                'choice_label'  => 'art_numero',
                'required'  => false,
                'attr' => [
                    'class' => 'form-group form-control form-control-sm',
                ],
            ])
            ->add('ctTypeVisite', EntityType::class, [
                'label' => 'Type visite',
                'class' => CtTypeVisite::class,
                'choice_label'  => 'tpvLibelle',
                'required'  => false,
                'attr' => [
                    'class' => 'form-group form-control js-example-basic-single'
                ],
            ])
            ->add('ctUsage', EntityType::class, [
                'label' => 'Usage',
                'class' => CtUsage::class,
                'choice_label'  => 'usgLibelle',
                'required'  => false,
                'attr' => [
                    'class' => 'form-group form-control js-example-basic-single'
                ],
            ])
            ->add('usgTrfPrix', NumberType::class, array(
                'label' => "Prix",
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ))
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
            'data_class' => CtUsageTarif::class,
        ]);
    }
}
