<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdduserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('username') /* le username est créé automatiquement par le controlleur */
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('password')
            ->add('admin')
            //->add('isActive') /* Champs utilisé pour la connexion user - Pas bien compris à quoi il servait*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
