<?php

namespace App\Tests\Entity;

use App\Tests\Entity\AbstractEntityTest;

class ArticleEntityTest extends AbstractEntityTest
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
        $this->assertNull($this->article->getId());
        $this->assertEquals('Title', $this->article->getTitle());
        $this->assertEquals('Description lorem ipsum', $this->article->getDescription());
        $this->assertTrue($this->article->getCreatedAt() instanceof \DateTime);
        $this->assertEquals('https://www.article-url.com', $this->article->getUrl());
        $this->assertEquals('https://www.article-img.com', $this->article->getImage());
    }

    public function testTitle($title = 'New title')
    {
        $this->article->setTitle($title);
        $this->assertEquals($title, $this->article->getTitle());
    }

    public function testDescription($description = 'New description lorem ipsum ...')
    {
        $this->article->setDescription($description);
        $this->assertEquals($description, $this->article->getDescription());
    }

    public function testCreatedAt()
    {
        $createdAt = \DateTime::createFromFormat('Y-m-d', '2019-01-01');
        $this->article->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $this->article->getCreatedAt());
    }

    public function testUrl($url = 'https://www.new-article-url.com')
    {
        $this->article->setUrl($url);
        $this->assertEquals($url, $this->article->getUrl());
    }

    public function testImage($image = 'https://www.new-article-img.com')
    {
        $this->article->setImage($image);
        $this->assertEquals($image, $this->article->getImage());
    }
}
