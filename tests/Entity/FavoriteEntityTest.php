<?php

namespace App\Tests\Entity;

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
        $this->assertNull($this->favorite->getUser());
    }
}
