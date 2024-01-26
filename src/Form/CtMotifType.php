<?php

namespace App\Form;

use App\Entity\CtMotif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CtMotifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mtfLibelle', TextType::class, [
                'label' => 'Libellé',
                'required'  => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('mtfIsCalculable', CheckboxType::class, [
                'label'     => 'Calculable ?',
                'required'  => false,
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
            'data_class' => CtMotif::class,
        ]);
    }
}
