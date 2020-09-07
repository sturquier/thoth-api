<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

class FavoriteControllerTest extends AbstractControllerTest
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testFavoriteCreationWithoutAuthentication()
    {
        $this->client->request('POST', '/favorites');

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $this->client->getResponse()->getStatusCode());
    }

    public function testFavoriteCreationWithoutPayload()
    {
        $this->login();

        $this->client->request('POST', '/favorites');

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->client->getResponse()->getStatusCode());
    }
}
