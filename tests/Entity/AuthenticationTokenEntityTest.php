<?php

namespace App\Tests\Entity;

use App\Entity\User;

class AuthenticationTokenEntityTest extends AbstractEntityTest
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
        $this->assertNull($this->authenticationToken->getId());
        $this->assertIsString($this->authenticationToken->getToken());
        $this->assertEquals($this->user, $this->authenticationToken->getUser());
    }

    public function testToken($token = 'a1b2c3')
    {
        $this->authenticationToken->setToken($token);
        $this->assertEquals($token, $this->authenticationToken->getToken());
    }

    public function testUser()
    {
        $user = new User();
        $this->authenticationToken->setUser($user);
        $this->assertEquals($user, $this->authenticationToken->getUser());
    }
}
