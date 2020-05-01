<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Article;
use App\Entity\Website;

abstract class AbstractEntityTest extends TestCase
{
    protected $article;
    protected $website;

    protected function setUp(): void
    {
        $this->website = new Website();
        $this->article = new Article(
            'Title',
            'Description lorem ipsum',
            \DateTime::createFromFormat('U', time()),
            'https://www.article-url.com',
            'https://www.article-img.com'
        );
    }

    protected function tearDown(): void
    {
        $this->website = NULL;
        $this->article = NULL;
    }
}
