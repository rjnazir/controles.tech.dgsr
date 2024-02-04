<?php

namespace App\Form;

use App\Entity\CtGenre;
use App\Entity\CtMarque;
use App\Entity\CtVehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CtVehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vhcCylindre', NumberType::class, [
                'label' => "Cylindrée",
                'required' => false,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('vhcPuissance', NumberType::class, [
                'label' => "Puissance",
                'required' => false,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('vhcPoidsVide', NumberType::class, [
                'label' => "Poids à vide",
                'required' => false,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('vhcChargeUtile', NumberType::class, [
                'label' => "Charge utile",
                'required' => false,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('vhcPoidsTotalCharge', NumberType::class, [
                'label' => "PTAC",
                'required' => false,
                'disabled' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ],
            ])
            ->add('vhcHauteur', NumberType::class, [
                'label' => "Hauteur",
                'required' => false,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ],
            ])
            ->add('vhcLargeur', NumberType::class, [
                'label' => "Largeur",
                'required' => false,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ],
            ])
            ->add('vhcLongueur', NumberType::class, [
                'label' => "Longueur",
                'required' => false,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ],
            ])
            ->add('vhcNumSerie', TextType::class, [
                'label' => "N° de série",
                'required' => false,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ],
            ])
            ->add('vhcNumMoteur', TextType::class, [
                'label' => 'Libellé',
                'required' => false,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                ]
            ])
            ->add('vhcProvenance', TextType::class, [
                'label' => 'Provenance',
                'required' => false,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                ]
            ])
            ->add('vhcType', TextType::class, [
                'label' => 'Type',
                'required' => false,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                ]
            ])
            ->add('ctGenre', EntityType::class, [
                'label' => 'Genre',
                'class' => CtGenre::class,
                'choice_label' => 'grLibelle ',
                'required'  => true,
                'attr' => [
                    'class' => 'form-group form-control js-example-basic-single'
                ],
                'placeholder'   => '- Séléctionner genre -',
            ])
            ->add('ctMarque', EntityType::class, [
                'label' => 'Marque',
                'class' => CtMarque::class,
                'choice_label'  => 'mrqLibelle',
                'required'  => true,
                'attr' => [
                    'class' => 'form-group form-control js-example-basic-single'
                ],
                'placeholder'   => '- Séléctionner marque -',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CtVehicule::class,
        ]);
    }
}
