<?php

namespace App\Form;

use App\Entity\CtCentre;
use App\Entity\CtProvince;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtCentreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ctr_nom', TextType::class, [
                'label'     => 'Libellé',
                'required'  => true,
            ])
            ->add('ctr_code', TextType::class, [
                'label'    => "Code",
                'required' => true
                ])
            ->add('ctr_acronyme', TextType::class, [
                'label'    => "Acronyme",
                'required' => false
            ])
            ->add('ctProvince', EntityType::class, [
                'label' => 'Province',
                'class' => CtProvince::class,
                'choice_label' => 'prvNom',
                'required'   => false,
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
            ])
            ->add('isParent', CheckboxType::class, [
                'label'     => 'Est centre parent ?',
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
            'data_class' => CtCentre::class,
        ]);
    }
}
