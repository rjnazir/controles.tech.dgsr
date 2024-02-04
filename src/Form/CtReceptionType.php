<?php

namespace App\Form;

use App\Entity\CtMotif;
use App\Entity\CtSourceEnergie;
use App\Entity\CtCarrosserie;
use App\Entity\CtReception;
use App\Entity\CtTypeReception;
use App\Entity\CtUtilisation;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CtReceptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $ctCentre = $options['ctCentre'];

        $builder
            ->add('rcpMiseService', null, [
                'label' => 'Mise en sce',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control form-control-sm datetimepicker',
                ],
                'required' => true,
            ])
            ->add('rcpImmatriculation', TextType::class, [
                'label' => 'Num imm.',
                'required'  => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('rcpProprietaire', TextType::class, [
                'label' => 'Proprietaire',
                'required'  => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('rcpProfession', TextType::class, [
                'label' => 'Profession',
                'required'  => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('rcpAdresse', TextType::class, [
                'label' => 'Adresse',
                'required'  => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('rcpNbrAssis', NumberType::class, [
                'label'    => "Place assis",
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('rcpNbrDebout', NumberType::class, [
                'label'    => "Place debout",
                'required' => true,
                'attr'  => [
                    'class' => 'form-control form-control-sm'
                ]
            ])

            ->add('ctTypeReception', EntityType::class, [
                'label' => 'Type RT',
                'class' => CtTypeReception::class,
                'query_builder' => function (EntityRepository $_er) {
                    return $_er
                        ->createQueryBuilder('tprcp')
                        ->orderBy('tprcp.tprcpLibelle', 'ASC');
                }, 
                'choice_label' => 'tprcpLibelle',
                'required'   => true,
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
                'placeholder'   => '- Séléctionner type réception -',
            ])

            ->add('ctMotif', EntityType::class, [
                'label' => 'Motif',
                'class' => CtMotif::class,
                'query_builder' => function (EntityRepository $_er) {
                    return $_er
                        ->createQueryBuilder('mtf')
                        ->orderBy('mtf.mtfLibelle', 'ASC');
                }, 
                'choice_label' => 'mtfLibelle',
                'required'   => true,
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
                'placeholder'   => '- Séléctionner motif -',
            ])
            ->add('ctVerificateur', EntityType::class, [
                'label'         => 'Vérificateur',
                'class'         => User::class,
                'query_builder' => function (EntityRepository $_er) use ($ctCentre) {
                    $_query_builder = $_er
                        ->createQueryBuilder('u')
                        ->where('u.roles LIKE :roles')
                        ->andWhere('u.userpresence = :presence')
                        ->setParameter('roles', '%ROLE_VTA%')
                        ->setParameter('presence', 1);

                    if ($ctCentre != '') {
                        $_query_builder
                            ->andWhere('u.ctCentre = :id_centre')
                            ->setParameter('id_centre', $ctCentre);
                    }

                    $_query_builder->orderBy('u.usrnamecomplet', 'ASC');

                    return $_query_builder;
                },
                'choice_label'  => 'usrnamecomplet',
                'multiple'      => false,
                'expanded'      => false,
                'required'      => true,
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
                'placeholder'   => '- Séléctionner verificateur -',
            ])
            ->add('ctUtilisation', EntityType::class, [
                'label'         => 'Utilisation',
                'class'         => CtUtilisation::class,
                'query_builder' => function (EntityRepository $_er) {
                    return $_er
                        ->createQueryBuilder('u')
                        ->orderBy('u.utLibelle', 'ASC');
                },
                'choice_label'  => 'utLibelle',
                'multiple'      => false,
                'expanded'      => false,
                'required'      => true,
                'placeholder'   => '- Séléctionner Utilisation -',
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
            ])
            ->add('ctVehicule', CtVehiculeType::class)
            ->add('ctSourceEnergie', EntityType::class, [
                'label'         => 'Source',
                'class'         => CtSourceEnergie::class,
                'query_builder' => function (EntityRepository $_er) {
                    return $_er
                        ->createQueryBuilder('s')
                        ->orderBy('s.sreLibelle', 'ASC');
                },
                'choice_label'  => 'sreLibelle',
                'multiple'      => false,
                'expanded'      => false,
                'required'      => true,
                'placeholder'   => '- Séléctionner énergie -',
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
            ])
            ->add('ctCarrosserie', EntityType::class, [
                'label' => 'Carosserie',
                'class' => CtCarrosserie::class,
                'query_builder' => function (EntityRepository $_er){
                    return $_er
                        ->createQueryBuilder('c')
                        ->orderBy('c.crsLibelle', 'ASC');
                },
                'choice_label' => 'crsLibelle',
                'multiple'      => false,
                'expanded'      => false,
                'required'      => true,                
                'attr' => [
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
                'placeholder'  => '- Séléctionner carosserie -',
            ])
            ->add('save', SubmitType::class, [
                'label'     => 'Enregistrer',
                'attr'      => [
                    'class' => 'col-4 btn btn-sm bg-gradient-success text-white',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CtReception::class,
        ]);

        $resolver->setRequired([
            'ctCentre',
        ]);
    }
}
