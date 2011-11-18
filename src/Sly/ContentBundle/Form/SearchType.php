<?php

namespace Sly\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Sly\ContentBundle\Entity\Content;

class SearchType extends AbstractType
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
                ->add('tags', 'text', array('required' => false))
                ->add('content', 'textarea')
                ->add('picture')
                ->add('status', 'checkbox', array('data' => true))
                // ->add('publishedAt', 'datetime', array('required' => false, 'years' => array(date('Y'), (date('Y')+1)), 'empty_value' => ''))
                ->add('publishedAt', 'datetime', array('required' => false, 'widget' => 'single_text'))
        ;
    }

    public function getName()
    {
        return 'content';
    }
}