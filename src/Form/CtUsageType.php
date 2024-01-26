<?php

namespace App\Form;

use App\Entity\CtUsage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtUsageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('usgLibelle', TextType::class, [
                'label' => 'Libellé',
                'required' => true,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                ]
            ])
            ->add('usgValidite', IntegerType::class, [
                'label' => 'Validité (en mois)',
                'required' => true,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                ]
            ])
            ->add('save', SubmitType::class, [
                'label'     => 'Enregistrer',
                'attr'      => [
                    'class' => 'col-2 btn btn-sm bg-gradient-success text-white',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CtUsage::class,
        ]);
    }
}
