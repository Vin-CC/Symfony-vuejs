<?php

namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

final class ArticleService
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * PostService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
