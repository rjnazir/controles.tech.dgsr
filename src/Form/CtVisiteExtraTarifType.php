<?php

namespace App\Form;

use App\Entity\CtArretePrix;
use App\Entity\CtVisiteExtra;
use App\Entity\CtVisiteExtraTarif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CtVisiteExtraTarifType extends AbstractType
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
            ->add('ctVisiteExtra', EntityType::class, [
                'label' => 'Visite extra',
                'class' => CtVisiteExtra::class,
                'choice_label'  => 'vsteLibelle',
                'required'  => false,
                'attr' => [
                    'class' => 'form-group form-control form-control-sm',
                ],
            ])
            ->add('vetPrix', NumberType::class, [
                'label' => "Prix",
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'col-2 btn btn-sm bg-gradient-success text-white',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CtVisiteExtraTarif::class,
        ]);
    }
}
