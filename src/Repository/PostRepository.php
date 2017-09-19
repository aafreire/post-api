<?php

namespace just\Repository;

use Doctrine\ORM\EntityRepository;
use just\Models\Post;

class PostRepository extends EntityRepository
{
    public function findByPath($path)
    {
        $builder= $this->_em->createQueryBuilder();

        $builder->select('a')
                ->from($this->getEntityName(), 'a')
                ->where('a.path = :path')
                ->setParameter('path', $path);

        $post = $builder->getQuery()->getSingleResult();

        return $post;
    }
}