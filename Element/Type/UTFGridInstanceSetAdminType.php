<?php

namespace WhereGroup\UTFGridBundle\Element\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UTFGridInstanceSetAdminType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'utfgridinstanceset';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'instances' => null
        ));
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
            'required' => true,
            'property_path' => '[title]'))
            ->add('instance', 'choice', array(
                'choices' => $options['instances'],
                'required' => true))
            ->add('templateUrl', 'text', array(
                'required' => true))
            ->add('format', 'textarea');
    }

}
