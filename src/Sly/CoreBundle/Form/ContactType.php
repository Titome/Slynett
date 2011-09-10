<?php

namespace Sly\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Sly\ContentBundle\Entity\Content;

class ContactType extends AbstractType
{
    public function getDefaultOptions(array $options)
    {
        return array();
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text')
                ->add('subject', 'choice', array(
                    'choices'   => array(
                        'Prise de contact - Questions diverses',
                        'Suggestions',
                        'Idéées de futurs tutoriels',
                        'Propositions de postes ou missions',
                        'Partenariats',
                        'Autres',
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