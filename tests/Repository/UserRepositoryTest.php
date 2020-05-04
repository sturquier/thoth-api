<?php

namespace App\Tests\Repository;

use App\Tests\Repository\AbstractRepositoryTest;
use App\Repository\UserRepository;
use App\Entity\User;

class UserRepositoryTest extends AbstractRepositoryTest
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
        $userRepository = $this->em->getRepository(User::class);

        $this->assertInstanceOf(UserRepository::class, $userRepository);
    }
}
