<?php

namespace App\Tests\Repository;

use App\Repository\FavoriteRepository;
use App\Entity\Favorite;

class FavoriteRepositoryTest extends AbstractRepositoryTest
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
        $favoriteRepository = $this->em->getRepository(Favorite::class);

        $this->assertInstanceOf(FavoriteRepository::class, $favoriteRepository);
    }
}
