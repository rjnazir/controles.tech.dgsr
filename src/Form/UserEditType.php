<?php

namespace App\Form;

use App\Entity\CtCentre;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DependencyInjection\Compiler\CheckDefinitionValidityPass;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $RoleName = $options['RoleName'];
        $ctrCode = $options['ctrCode'];

        $builder
            ->add('username', TextType::class, [
                'label'     => 'Login d\'utilisateur',
                'required'   => true,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('usrnamecomplet', TextType::class, [
                'label'     => 'Nom et prénoms',
                'required'   => true,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('userfonction', TextType::class, [
                'label'     => 'Fonction',
                'required'   => true,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('useradresse', TextType::class, [
                'label'     => 'Adresse',
                'required'   => true,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('userphone', TextType::class, [
                'label'     => 'Téléphone',
                'required'   => true,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('usermail', EmailType::class, [
                'label'     => 'E-mail',
                'required'   => true,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('actived', CheckboxType::class, [
                'label'     => 'Est active ?',
                'required'  => false,
            ])
            ->add('userpresence', CheckboxType::class, [
                'label'     => 'Est présent ?',
                'required'  => false,
            ])
            ->add('ctCentre', EntityType::class, [
                'label' => 'Centre',
                'class' => CtCentre::class,
                'choice_label' => 'ctrNom',
                'query_builder' => function (EntityRepository $_er) use ($RoleName, $ctrCode) {
                    if(in_array('ROLE_ADMIN', $RoleName)){
                        return $_er
                            ->createQueryBuilder('c')
                            ->where("c.ctr_code = '".$ctrCode."'")
                            ->orderBy('c.ctr_nom', 'ASC');
                    }else{
                        return $_er
                            ->createQueryBuilder('c')
                            ->orderBy('c.ctr_nom', 'ASC');
                    }
                },
                'group_by'     => function (CtCentre $_centre) {
                    if ($_centre->getCtProvince())
                        return $_centre->getCtProvince()->getPrvNom();
                },
                'attr' => [
                    'class' => 'col-sm-12 form-control text-uppercase'
                ],
                'required'  => false,
            ])
            ->add('roles', ChoiceType::class, [
                'label'     => 'Rôle de l\'utilisateur',
                'choices'   => [
                    'Superadmin'        => 'ROLE_SUPERADMIN',
                    'Administrateur'    => 'ROLE_ADMIN',
                    'Utilisateur'       => 'ROLE_USER',
                    'Consultation'      => 'ROLE_STAFF',
                    'Vérificateur'      => 'ROLE_VTA',
                    'Approvisionnement' => 'ROLE_APPRO',
                ],
                'required'  => true,
                'expanded'  => false,
                'multiple'  => true,
                'attr'      => [
                    'class' => 'form-control select-sm',
                ]
            ])
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'empty_data' => ''
            ])
            ->add('password', RepeatedType::class, [
                'type'  => PasswordType::class,
                'invalid_message'   => 'Les mots de passe sont différents.',
                'options'   => [
                    'attr'  => [
                        'class' => 'form-control form-control-sm password-field'
                    ]
                ],
                'required'  => false,
                'first_options' => ['label' => 'Entrer votre mot de passe'],
                'second_options'=> ['label' => 'Rétaper votre mot de passe'],
                'empty_data' => '',
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
            'data_class' => User::class,
        ]);

        $resolver->setRequired([
            'RoleName',
            'ctrCode',
        ]);
    }
}
