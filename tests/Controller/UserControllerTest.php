<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends AbstractControllerTest
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testUserCreationWithoutPayload()
    {
        $this->client->request('POST', '/users');

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->client->getResponse()->getStatusCode());
    }

    public function testUserCreationWithPartialEmail()
    {
        $this->client->request('POST', '/users', [
            'email' => 'foo',
            'password' => 'fooBar1'
        ]);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }

    public function testUserCreationWithPartialPassword()
    {
        $this->client->request('POST', '/users', [
            'email' => 'foo@bar.com',
            'password' => 'foo'
        ]);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }

    public function testUserCreationWithCompletePayload()
    {
        $this->client->request('POST', '/users', [
            'email' => 'foo@bar.com',
            'password' => 'fooBar1'
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }

    public function testUserLoginWithoutPayload()
    {
        $this->client->request('POST', '/users/login');

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $this->client->getResponse()->getStatusCode());
    }

    public function testUserLoginWithPayload()
    {
        $this->client->request('POST', '/users/login', [
            'email' => 'foo@bar.com',
            'password' => 'fooBar1'
        ]);

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $this->client->getResponse()->getStatusCode());
    }
}
