<?php

namespace App\Form;

use App\Entity\Links;
use App\Entity\Categories;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('tagline')
            ->add('detail')
            ->add('url')
            ->add('idcategory', EntityType::class, [    /* J'ai gardé la catégorie du lien */
                'class' => Categories::class,           /* Le client avait pas l'air trop d'accord */
                'choice_label' => 'name'                /* A voir */
                ])
            //->add('iduser', EntityType::class, [  /* Lors de la création du lien, */
            //    'class' => Users::class,          /* l'id du user connécté sera */
            //   'choice_label' => 'lastname'       /* automatiquement injecté */
            //    ])
            //->add('datecreate')                   /* *les dates sont crées et/
            //->add('dateupdate')                   /* modifiées automatiquement */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Links::class,
        ]);
    }
}
