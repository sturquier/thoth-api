<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

class MeControllerTest extends AbstractControllerTest
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testUnauthorizedRequestOnProfileSearch()
    {
        $this->client->request('GET', '/me');

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequestOnProfileSearch()
    {
        $this->login();

        $this->client->request('GET', '/me');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testUnauthorizedRequestOnFavoriteArticlesSearch()
    {
        $this->client->request('GET', '/me/favorites');

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequestonFavoriteArticlesSearch()
    {
        $this->login();

        $this->client->request('GET', '/me/favorites');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}
