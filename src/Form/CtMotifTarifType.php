<?php

namespace App\Form;

use App\Entity\CtArretePrix;
use App\Entity\CtMotif;
use App\Entity\CtMotifTarif;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CtMotifTarifType extends AbstractType
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
            ->add('ctMotif', EntityType::class, array(
                'class' => CtMotif::class,
                'label' => "Motif",
                'choice_label' => 'mtfLibelle',
                'required'  => false,
                'attr' => [
                    'class' => 'form-group form-control js-example-basic-single'
                ],
            ))
            ->add('mtfTrfPrix', NumberType::class, array(
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
            'data_class' => CtMotifTarif::class,
        ]);
    }
}
