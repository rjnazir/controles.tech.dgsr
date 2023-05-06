<?php

namespace App\Form;

use App\Entity\CtAnomalie;
use App\Entity\CtAnomalieType as CtAnomalieTypes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CtAnomalieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('anml_libelle', TextType::class, [
                'label' => 'Libellé',
                'required'  => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('anml_code', TextType::class, [
                'label' => 'Code',
                'required'  => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('ctAnomalieType', EntityType::class, [
                'label' => 'Type',
                'class' => CtAnomalieTypes::class,
                'choice_label'  => 'atpLibelle',
                'required'  => false,
                'attr' => [
                    'class' => 'form-group form-control js-example-basic-single'
                ],
            ])
            ->add('save', SubmitType::class, [
                'label'     => 'Enregistrer',
                'attr'      => [
                    'class' => 'col-2 btn btn-sm btn-success',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CtAnomalie::class,
        ]);
    }
}
