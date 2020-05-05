<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Tests\Controller\AbstractControllerTest;

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

    public function testRequestWithPayload()
    {
        $this->client->request('POST', '/users', [
            'email' => 'foo@bar.com',
            'password' => 'fooBar1'
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }
}
