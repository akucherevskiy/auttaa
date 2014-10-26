<?php

namespace Auttaa\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SubscribeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', NULL, array('required' => true));
        $builder->add('Get early access', 'submit', array('attr' => array('class'=>'btn btn-success')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Auttaa\WebBundle\Entity\User'
        ));
    }


    public function getName()
    {
        return 'subscribe';
    }
}
