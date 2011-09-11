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
        );
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text')
                ->add('email', 'email')
                ->add('twitter', 'text', array('required' => false))
                ->add('subject', 'choice', array(
                    'choices'   => array(
                        'Prise de contact - Questions diverses' => 'Prise de contact - Questions diverses',
                        'Suggestions' => 'Suggestions',
                        'Idéées de futurs tutoriels' => 'Idéées de futurs tutoriels',
                        'Propositions de postes ou missions' => 'Propositions de postes ou missions',
                        'Partenariats' => 'Partenariats',
                        'Autres' => 'Autres',
                    ),
                    'required'  => false,
                    'empty_value' => false,
                ))
                ->add('message', 'textarea')
        ;
    }

    public function getName()
    {
        return 'contact';
    }
}