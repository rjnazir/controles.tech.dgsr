<?php

namespace App\Form;

use App\Entity\CtImprimeTech;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CtImprimeTechType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomImprimeTech', TextType::class, array(
                'label'    => 'Nom type d\'imprimé',
                'required' => true
            ))
            ->add('abrevImprimeTech', TextType::class, array(
                'label'    => 'Code',
                'required' => true
            ))
            ->add('uniteImprimeTech', TextType::class, array(
                'label'    => 'Unité',
                'required' => true
            ))
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
            'data_class' => CtImprimeTech::class,
        ]);
    }
}
