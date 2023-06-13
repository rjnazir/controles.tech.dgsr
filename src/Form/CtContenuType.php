<?php

namespace App\Form;

use App\Entity\CtContenu;
use App\Entity\CtExpressionBesoin;
use App\Entity\CtImprimeTech;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CtContenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ctExpressionBesoin', EntityType::class, [
                'label' => 'Réf. de l\'EDB',
                'class' => CtExpressionBesoin::class,
                'choice_label' => 'edbNumero',
                'required'   => false,
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
            ])
            ->add('ctImprimeTech', EntityType::class, [
                'label' => 'Type d\'imprimé',
                'class' => CtImprimeTech::class,
                'choice_label' => 'nomImprimeTech',
                'required'   => false,
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
            ])
            ->add('qteDemande', NumberType::class, [
                'label' => 'Quantité',
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            // ->add('debutNumero', NumberType::class, [
            //     'label' => 'Début numéro imprimé',
            //     'required'   => true,
            //     'attr'  => [
            //         'class' => 'form-control form-control-sm',
            //     ]
            // ])
            // ->add('finNumero', NumberType::class, [
            //     'label' => 'Fin numéro imprimé',
            //     'required'   => true,
            //     'attr'  => [
            //         'class' => 'form-control form-control-sm',
            //     ]
            // ])
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
            'data_class' => CtContenu::class,
        ]);
    }
}
