<?php

namespace Acme\RecipeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompositeType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('recipe', 'entity', array(
//                    'class' => 'Acme\RecipeBundle\Entity\Recipe',
//                    'property' => 'id',
//                    'multiple' => false,
//                    'expanded' => false,
//                    'label' => true
//                        )
//                )
                ->add('recipe')
                ->add('ingredient')
                ->add('quantity')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\RecipeBundle\Entity\Composite'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'compositeType';
    }

}
