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
    
    public function getLastItems($contentType, $categories, $number = 5)
    {
        $q = $this->createQueryBuilder('c')
            ->select('c, cat')
            ->leftJoin('c.categories', 'cat')
            ->where('c.status = true');
            
        if ($categories)
        {
            $categoriesArray = array();
            
            foreach ($categories as $c)
                $categoriesArray[] = $c->getId();

            $q->andWhere('cat.id IN (:contentCategories)')
                ->setParameter('contentCategories', implode(',', $categoriesArray));
        }
            
        if ($contentType)
        {
            $q->andWhere('c.type = :contentType')
                ->setParameter('contentType', $contentType);
        }
            
        $q->orderBy('c.publishedAt', 'DESC')
            ->setMaxResults($number);
        
        return $q->getQuery()->getResult();
    }

    public function getLastActivity($number, $start = 0)
    {        
        $q = $this->createQueryBuilder('c')
            ->select('c, cat')
            ->leftJoin('c.categories', 'cat')
            ->where('c.status = true')
            ->setFirstResult($start)
            ->setMaxResults($number);
            
        $q->orderBy('c.publishedAt', 'DESC');
        
        return $q->getQuery()->getResult();
    }
    
    public function getSitemapItems()
    {
        $q = $this->createQueryBuilder('c')
            ->select('c, cat')
            ->leftJoin('c.categories', 'cat')
            ->where('c.status = true')
            ->andWhere('c.publishedAt <= :now')
            ->andWhere('c.type NOT IN (:notInTypes)')
            ->setParameters(array(
                'now' => date('Y-m-d H:i:s'),
                'notInTypes' => array('watch', 'twitter'),
            ))
            ->orderBy('c.publishedAt', 'DESC');
        
        return $q->getQuery()->getResult();
    }
}