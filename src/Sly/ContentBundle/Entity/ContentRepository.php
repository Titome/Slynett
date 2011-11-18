<?php

namespace Sly\ContentBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ContentRepository extends EntityRepository
{
    public function getFeed($type, $numberOfItems = 10)
    {
        $q = $this->createQueryBuilder('c')
            ->select('c, cat')
            ->leftJoin('c.categories', 'cat')
            ->where('c.status = true')
            ->andWhere('c.publishedAt <= :now');
        
        if ($type)
            $q->andWhere('c.type = :contentType')
                ->setParameter('contentType', $type);
        else
            $q->andWhere('c.type NOT IN (\'watch\',\'twitter\')');
            
        $q->setParameter('now', date('Y-m-d H:i:s'))
            ->orderBy('c.publishedAt', 'DESC')
            ->setMaxResults($numberOfItems);
        
        return $q->getQuery()->getResult();
    }
    
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
    
    public function getLastItems($contentType, $categories, $number = 5, $withoutItem = null)
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
        
        if ($withoutItem)
        {
            $q->andWhere('c.id != :withoutItemId')
                ->setParameter('withoutItemId', $withoutItem->getId());
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
            ->andWhere('c.type NOT IN (:excludedTypes)')
            ->setParameters(array(
                'now' => date('Y-m-d H:i:s'),
                'excludedTypes' => array('watch', 'twitter')
            ))
            ->orderBy('c.publishedAt', 'DESC');
        
        return $q->getQuery()->getResult();
    }
    
    public function getLastTweet()
    {
        $q = $this->createQueryBuilder('c')
            ->where('c.status = true')
            ->andWhere('c.type = :type')
            ->setParameter('type', 'twitter')
            ->orderBy('c.socialNetworkId', 'DESC')
            ->setMaxResults(1);
        
        return $q->getQuery()->getOneOrNullResult();
    }
    
    public function searchContent($query, $categories, $count)
    {
        $q = $this->createQueryBuilder('c')
            ->select('c, cat')
            ->leftJoin('c.categories', 'cat')
            ->where('c.status = true')
            ->andWhere('c.type IN (:type)')
            ->andWhere('(c.title LIKE :query) OR (c.tags LIKE :query)')
            ->setParameters(array(
                'type' => $categories,
                'query' => '%'.$query.'%',
            ))
            ->orderBy('c.publishedAt', 'DESC')
            ->setMaxResults($count);
        
        return $q->getQuery()->getResult();
    }
}