<?php

namespace App\Tests\Security;

use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use App\Security\TokenAuthenticator;
use App\Entity\User;

class TokenAuthenticatorTest extends TestCase
{
    private $tokenAuthenticator;
    private $request;
    private $authException;

    protected function setUp(): void
    {
        $this->tokenAuthenticator = new TokenAuthenticator($this->createMock(EntityManagerInterface::class));
        $this->request = new Request();
        $this->authException = new AuthenticationException();
    }

    protected function tearDown(): void
    {
        $this->tokenAuthenticator = null;
        $this->request = null;
        $this->authException = null;
    }

    public function testGetCredentials()
    {
        $this->request->headers->set('Authorization', 'Bearer a1b2c3');

        $this->assertEquals('a1b2c3', $this->tokenAuthenticator->getCredentials($this->request));
    }

    public function testCheckCredentials()
    {
        $this->assertTrue($this->tokenAuthenticator->checkCredentials('a1b2c3', new User()));
    }

    public function testOnAuthenticationSuccess()
    {
        $success = $this
            ->tokenAuthenticator
            ->onAuthenticationSuccess($this->request, $this->createMock(TokenInterface::class), 'main')
        ;

        $this->assertNull($success);
    }

    public function testOnAuthenticationFailure()
    {
        $failure = $this
            ->tokenAuthenticator
            ->onAuthenticationFailure($this->request, $this->authException)
        ;

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $failure->getStatusCode());
    }

    public function testSupportsRememberMe()
    {
        $this->assertFalse($this->tokenAuthenticator->supportsRememberMe());
    }
}
