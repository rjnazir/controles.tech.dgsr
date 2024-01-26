<?php

namespace App\Form;

use App\Entity\CtDroitPtac;
use App\Entity\CtArretePrix;
use App\Entity\CtGenreCategorie;
use App\Entity\CtTypeDroitPtac;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CtDroitPtacType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ctArretePrix', EntityType::class, [
                'label' => 'Arrêté',
                'class' => CtArretePrix::class,
                'query_builder' => function (EntityRepository $_er) {
                    return $_er
                        ->createQueryBuilder('t')
                        ->orderBy('t.art_date_applic', 'DESC');
                },
                'choice_label'  => 'art_numero',
                'multiple'  => false,
                'expanded'  => false,
                'required'  => false,
                'attr' => [
                    'class' => 'form-group form-control js-example-basic-single'
                ],
            ])
            ->add('ctGenreCategorie', EntityType::class, [
                'label' => "Catégorie",
                'class' => CtGenreCategorie::class,
                'choice_label' => 'gcLibelle',
                'required'  => false,
                'attr' => [
                    'class' => 'form-group form-control js-example-basic-single'
                ],
            ])
            ->add('ctTypeDroitPtac', EntityType::class, [
                'label' => "Catégorie",
                'class' => CtTypeDroitPtac::class,
                'choice_label' => 'tpDpLibelle',
                'required'  => false,
                'attr' => [
                    'class' => 'form-group form-control js-example-basic-single'
                ],
            ])
            ->add('dpPoidsMin', NumberType::class, array(
                'label' => "Poids minimum (T)",
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ))
            ->add('dpPoidsMax', NumberType::class, array(
                'label' => "Poids maximum (T)",
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ))
            ->add('dpDroit', NumberType::class, array(
                'label' => "Droit",
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ))
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
            'data_class' => CtDroitPtac::class,
        ]);
    }
}
