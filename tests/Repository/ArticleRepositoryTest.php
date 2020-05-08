<?php

namespace App\Tests\Repository;

use App\Repository\ArticleRepository;
use App\Entity\Article;

class ArticleRepositoryTest extends AbstractRepositoryTest
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testConstructor()
    {
        $articleRepository = $this->em->getRepository(Article::class);

        $this->assertInstanceOf(ArticleRepository::class, $articleRepository);
    }
}
