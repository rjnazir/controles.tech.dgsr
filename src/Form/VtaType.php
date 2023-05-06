<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use App\Entity\CtCentre;

class VtaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $RoleName = $options['RoleName'];
        $ctrCode = $options['ctrCode'];

        $builder
            ->add('usermail', EmailType::class, [
                'label'     => 'Adresse e-mail'   ,
                'required'  => true,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('usrnamecomplet', TextType::class, [
                'label'     => 'Nom et prénoms du vérificateur',
                'required'  => true,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('userfonction', TextType::class, [
                'label'     => 'Fonction du vérificateur',
                'required'  => true,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('userphone', TextType::class, [
                'label'     => 'Téléphone',
                'required'  => false,
                'attr'      => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('useradresse', TextType::class, [
                'label'     => 'Adresse du vérificateur',
                'required'  => true,
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
                'required'  => false,
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
                    'class' => 'col-sm-12 form-control js-example-basic-single'
                ],
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
