<?php

namespace Sly\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Sly\ContentBundle\Entity\Content;

class WatchLinkType extends AbstractType
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
                ->add('link', 'url')
                ->add('tags', 'text', array('required' => false))
        ;
    }

    public function getName()
    {
        return 'content';
    }
}