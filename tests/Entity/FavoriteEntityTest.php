<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Entity\User;

class FavoriteEntityTest extends AbstractEntityTest
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
        $this->assertNull($this->favorite->getId());
        $this->assertNull($this->favorite->getArticle());
        $this->assertEquals($this->user, $this->favorite->getUser());
    }

    public function testArticle()
    {
        $article = new Article(
            'New title',
            'Lorem ipsum dolor sit amet',
            \DateTime::createFromFormat('U', time()),
            'https://www.url.com',
            'https://www.image.com'
        );
        $this->favorite->setArticle($article);
        $this->assertEquals($article, $this->favorite->getArticle());
    }

    public function testUser()
    {
        $user = new User();
        $this->favorite->setUser($user);
        $this->assertEquals($user, $this->favorite->getUser());
    }
}
