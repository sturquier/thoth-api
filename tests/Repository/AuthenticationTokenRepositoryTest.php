<?php

namespace App\Tests\Repository;

use App\Repository\AuthenticationTokenRepository;
use App\Entity\AuthenticationToken;

class AuthenticationTokenRepositoryTest extends AbstractRepositoryTest
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
        $authenticationTokenRepository = $this->em->getRepository(AuthenticationToken::class);

        $this->assertInstanceOf(AuthenticationTokenRepository::class, $authenticationTokenRepository);
    }
}
