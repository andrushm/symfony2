<?php

namespace Acme\RecipeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecipeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('created')
            ->add('updated')
            ->add('composite')
            ->add('user')
//            ->add('composite', 'collection', array(
//                                               'label' => 'Компоненти',
//                                               'type' => new CompositeType(),
//                                               'allow_add' => true,
//                                               'allow_delete' => true,
//                                               'prototype' => false,
//                                              ));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\RecipeBundle\Entity\Recipe'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_recipebundle_recipe';
    }
}
