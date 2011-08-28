<?php

namespace Sly\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Sly\ContentBundle\Entity\Content;

class TutorialType extends AbstractType
{
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Sly\ContentBundle\Entity\Content',
        );
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('categories', null)
                ->add('title', 'text')
                ->add('excerpt', 'textarea', array('required' => false))
                ->add('content', 'textarea', array('required' => false))
                ->add('picture')
                ->add('link', 'url', array('required' => false))
                ->add('status', 'checkbox', array('data' => true))
                ->add('publishedAt', 'datetime', array('required' => false, 'widget' => 'single_text'))
        ;
    }

    public function getName()
    {
        return 'content';
    }
}