<?php

namespace BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BlogRepository extends EntityRepository
{
    /**
     * Number of blog posts
     * @return mixed
     */
    public function findBlogCount()
    {
        $query = $this->createQueryBuilder("b")
            ->select("count(b)");

        return $query->getQuery()->getOneOrNullResult();
    }

    /**
     * @param int $page
     * @return array
     */
    public function findAllBlog($page = 0)
    {
        $totalPost = 5;
        //$page = $totalPost * ($page - 1);
        $query = $this->createQueryBuilder('b')
            ->select('b')
            ->orderBy('b.id', 'DESC');

        return $query->getQuery()->getResult();
    }
}