<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Article;
use App\Entity\AuthenticationToken;
use App\Entity\Favorite;
use App\Entity\User;
use App\Entity\Website;

abstract class AbstractEntityTest extends TestCase
{
    protected $article;
    protected $authenticationToken;
    protected $favorite;
    protected $user;
    protected $website;

    protected function setUp(): void
    {
        $this->article = new Article(
            'Title',
            'Description lorem ipsum',
            \DateTime::createFromFormat('U', time()),
            'https://www.article-url.com',
            'https://www.article-img.com'
        );
        $this->user = new User();
        $this->website = new Website();

        $this->authenticationToken = new AuthenticationToken($this->user);
        $this->favorite = new Favorite($this->user);
    }

    protected function tearDown(): void
    {
        $this->article = null;
        $this->user = null;
        $this->website = null;

        $this->authenticationToken = null;
        $this->favorite = null;
    }
}
