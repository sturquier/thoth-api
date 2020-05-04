<?php

namespace App\Tests\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Tests\Entity\AbstractEntityTest;

class UserEntityTest extends AbstractEntityTest
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
        $this->assertNull($this->user->getId());
        $this->assertNull($this->user->getEmail());
        $this->assertEquals('', $this->user->getUsername());
        $this->assertEquals(['ROLE_USER'], $this->user->getRoles());
        $this->assertEquals('', $this->user->getPassword());
        $this->assertNull($this->user->getSalt());
        $this->assertNull($this->user->eraseCredentials());
    }

    public function testEmail($email = 'foo@bar.com')
    {
        $this->user->setEmail($email);
        $this->assertEquals($email, $this->user->getEmail());
    }

    public function testRoles($roles = ['ROLE_ADMIN'])
    {
        $this->user->setRoles($roles);
        $this->assertEquals(['ROLE_ADMIN', 'ROLE_USER'], $this->user->getRoles());
    }

    public function testPassword($password = 'fooBar1')
    {
        $this->user->setPassword($password);
        $this->assertEquals($password, $this->user->getPassword());
    }
}
