<?php

namespace App\Form;

use App\Entity\CtAnomalieType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtAnomalieTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('atp_libelle', TextType::class, [
                'label'     => 'Libellé type d\'anomalie',
                'required'  => true,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label'     => 'Enregistrer',
                'attr'      => [
                    'class' => 'btn btn-sm bg-gradient-success text-white'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CtAnomalieType::class,
        ]);
    }
}
