<?php

namespace Sly\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Sly\CoreBundle\Entity\Contact;

class ContactType extends AbstractType
{
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Sly\CoreBundle\Entity\Contact',
            'ref' => $options['ref'],
            'subjects' => $options['subjects'],
        );
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text')
                ->add('email', 'email')
                ->add('twitter', 'text', array('required' => false))
                ->add('subject', 'choice', array(
                    'choices'   => $options['subjects'],
                    'required'  => false,
                    'empty_value' => false,
                    'preferred_choices' => $options['ref']?array(3):array(),
                ))
                ->add('message', 'textarea')
                ->add('mlkqsd', 'text', array('required' => false))
        ;
    }

    public function getName()
    {
        return 'contact';
    }
}