<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use App\Entity\User;

abstract class AbstractControllerTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        self::ensureKernelShutdown();

        $this->client = static::createClient();
    }

    protected function tearDown(): void
    {
        $this->client = null;
    }

    protected function login()
    {
        $container = self::$container;
        $security = $container->get('security.token_storage');

        $firewallName = 'main';

        $user = new User();
        $user->setEmail('foo@bar.com');
        $user->setPassword('fooBar1');

        $token = new PostAuthenticationGuardToken($user, $firewallName, $user->getRoles());

        $security->setToken($token);
    }
}
