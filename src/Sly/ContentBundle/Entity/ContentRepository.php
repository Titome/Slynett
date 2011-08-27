<?php

namespace Sly\ContentBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ContentRepository extends EntityRepository
{
    public function getContentQ($contentType = null)
    {
        $q = $this->createQueryBuilder('c')
            ->select('c, cat')
            ->leftJoin('c.categories', 'cat')
            ->where('c.status = true')
            ->andWhere('c.publishedAt <= :now');
            
        if ($contentType)
        {
            $q->andWhere('c.type = :contentType')
                ->setParameter('contentType', $contentType);
        }
            
        $q->setParameter('now', date('Y-m-d H:i:s'))
            ->orderBy('c.publishedAt', 'DESC');
        
        return $q->getQuery();
    }
    
    public function getContentByCategoryQ($category, $contentType = null)
    {
        $q = $this->createQueryBuilder('c')
            ->select('c, cat')
            ->leftJoin('c.categories', 'cat')
            ->where('c.status = true')
            ->andWhere('cat.id = :categoryId')
            ->andWhere('c.publishedAt <= :now')
            ->setParameters(array(
                'categoryId' => $category->getId(),
                'now' => date('Y-m-d H:i:s'),
            ));
            
        if ($contentType)
        {
            $q->andWhere('c.type = :contentType')
                ->setParameter('contentType', $contentType);
        }
        
        $q->orderBy('c.publishedAt', 'DESC');
        
        return $q->getQuery();
    }
}