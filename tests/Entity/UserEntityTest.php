<?php

namespace App\Tests\Entity;

use Doctrine\Common\Collections\ArrayCollection;

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
        $this->assertNull($this->user->getFirstName());
        $this->assertNull($this->user->getLastName());
        $this->assertNull($this->user->getEmail());
        $this->assertEquals('', $this->user->getUsername());
        $this->assertEquals(['ROLE_USER'], $this->user->getRoles());
        $this->assertEquals('', $this->user->getPassword());
        $this->assertNull($this->user->getSalt());
        $this->assertNull($this->user->eraseCredentials());
        $this->assertEquals(new ArrayCollection(), $this->user->getFavorites());
    }

    public function testFirstName($firstName = 'Foo')
    {
        $this->user->setFirstName($firstName);
        $this->assertEquals($firstName, $this->user->getFirstName());
    }

    public function testLastName($lastName = 'Bar')
    {
        $this->user->setLastName($lastName);
        $this->assertEquals($lastName, $this->user->getLastName());
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

    public function testFavoriteAddition()
    {
        $this->assertTrue($this->user->getFavorites()->isEmpty());
        $this->user->addFavorite($this->favorite);
        $this->assertTrue(!$this->user->getFavorites()->isEmpty());
    }

    public function testFavoriteRemoval()
    {
        $this->user->addFavorite($this->favorite);
        $this->assertTrue(!$this->user->getFavorites()->isEmpty());
        $this->user->removeFavorite($this->favorite);
        $this->assertTrue($this->user->getFavorites()->isEmpty());
    }
}
