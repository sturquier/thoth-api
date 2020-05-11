<?php

namespace App\Tests\Security;

use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use App\Security\LoginAuthenticator;
use App\Entity\User;

class LoginAuthenticatorTest extends TestCase
{
    private $loginAuthenticator;
    private $request;
    private $authException;

    protected function setUp(): void
    {
        $this->loginAuthenticator = new LoginAuthenticator(
            $this->createMock(EntityManagerInterface::class),
            $this->createMock(UserPasswordEncoderInterface::class)
        );
        $this->request = new Request();
        $this->authException = new AuthenticationException();
    }

    protected function tearDown(): void
    {
        $this->loginAuthenticator = null;
        $this->request = null;
        $this->authException = null;
    }

    public function testGetCredentials()
    {
        $this->request->request->set('email', 'foo@bar.com');
        $this->request->request->set('password', 'fooBar1');

        $this->assertEquals(
            [
                'email' => 'foo@bar.com',
                'password' => 'fooBar1'
            ],
            $this->loginAuthenticator->getCredentials($this->request)
        );
    }

    public function testCheckCredentials()
    {
        $user = new User();
        $user->setPassword('fooBar1');

        $credentials = ['password' => 'fooBar2'];

        $this->assertNull($this->loginAuthenticator->checkCredentials($credentials, $user));
    }

    public function testOnAuthenticationFailure()
    {
        $failure = $this
            ->loginAuthenticator
            ->onAuthenticationFailure($this->request, $this->authException)
        ;

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $failure->getStatusCode());
    }

    public function testStart()
    {
        $this->assertNull($this->loginAuthenticator->start($this->request, $this->authException));
    }

    public function testSupportsRememberMe()
    {
        $this->assertFalse($this->loginAuthenticator->supportsRememberMe());
    }
}
