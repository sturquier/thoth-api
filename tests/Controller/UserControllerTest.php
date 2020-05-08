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

    public function testRequestWithoutPayload()
    {
        $this->client->request('POST', '/users');

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->client->getResponse()->getStatusCode());
    }

    public function testRequestWithPartialEmail()
    {
        $this->client->request('POST', '/users', [
            'email' => 'foo',
            'password' => 'fooBar1'
        ]);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }

    public function testRequestWithPartialPassword()
    {
        $this->client->request('POST', '/users', [
            'email' => 'foo@bar.com',
            'password' => 'foo'
        ]);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }

    public function testRequestWithCompletePayload()
    {
        $this->client->request('POST', '/users', [
            'email' => 'foo@bar.com',
            'password' => 'fooBar1'
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }
}
