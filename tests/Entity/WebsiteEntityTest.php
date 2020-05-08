<?php

namespace App\Tests\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class WebsiteEntityTest extends AbstractEntityTest
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
        $this->assertNull($this->website->getId());
        $this->assertNull($this->website->getName());
        $this->assertNull($this->website->getUrl());
        $this->assertEquals(new ArrayCollection(), $this->website->getArticles());
    }

    public function testName($name = 'Website name')
    {
        $this->website->setName($name);
        $this->assertEquals($name, $this->website->getName());
    }

    public function testUrl($url = 'https://www.website.com')
    {
        $this->website->setUrl($url);
        $this->assertEquals($url, $this->website->getUrl());
    }

    public function testArticleAddition()
    {
        $this->assertTrue($this->website->getArticles()->isEmpty());
        $this->website->addArticle($this->article);
        $this->assertTrue(!$this->website->getArticles()->isEmpty());
    }

    public function testArticleRemoval()
    {
        $this->website->addArticle($this->article);
        $this->assertTrue(!$this->website->getArticles()->isEmpty());
        $this->website->removeArticle($this->article);
        $this->assertTrue($this->website->getArticles()->isEmpty());
    }
}
