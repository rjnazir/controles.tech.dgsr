<?php

namespace App\Form;

use App\Entity\CtGenre;
use App\Entity\CtGenreCategorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CtGenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ctGenreCategorie', EntityType::class, [
                'label' => "Catégorie",
                'class' => CtGenreCategorie::class,
                'choice_label' => 'gcLibelle',
                'required'  => false,
                'attr' => [
                    'class' => 'form-group form-control js-example-basic-single'
                ],
            ])
            ->add('grLibelle', TextType::class, [
                'label' => "Libellé",
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('grCode', TextType::class, [
                'label' => "Code",
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
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
            'data_class' => CtGenre::class,
        ]);
    }
}
