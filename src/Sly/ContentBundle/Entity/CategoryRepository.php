<?php

namespace Sly\ContentBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function getCategories($contentType = null)
    {
        $q = $this->createQueryBuilder('c')
            ->select('c, content')
            ->leftJoin('c.content', 'content')
            ->where('c.status = true');
        
        if ($contentType)
        {
            $q->andWhere('content.type = :contentType')
                ->setParameter('contentType', $contentType);
        }
        
        $q->orderBy('c.name', 'ASC');
        
        return $q->getQuery()->getResult();
    }
}