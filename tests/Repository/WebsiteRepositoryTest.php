<?php

namespace App\Tests\Repository;

use App\Tests\Repository\AbstractRepositoryTest;
use App\Repository\WebsiteRepository;
use App\Entity\Website;

class WebsiteRepositoryTest extends AbstractRepositoryTest
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
        $websiteRepository = $this->em->getRepository(Website::class);

        $this->assertInstanceOf(WebsiteRepository::class, $websiteRepository);
    }
}
