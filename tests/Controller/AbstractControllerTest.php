<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
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
        $this->client = NULL;
    }

    protected function login()
    {
        $container = self::$container;
        $session = $container->get('session');
        $em = $container->get('doctrine.orm.entity_manager');

        $firewallName = 'main';

        $user = $em->getRepository(User::class)->findOneBy([]);
        $token = new PostAuthenticationGuardToken($user, $firewallName, $user->getRoles());
        
        $session->set('_security_'.$firewallName, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}
