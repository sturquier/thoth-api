<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

class ArticleControllerTest extends AbstractControllerTest
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testUnauthorizedRequest()
    {
        $this->client->request('GET', '/articles');

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequest()
    {
        $this->login();

        $this->client->request('GET', '/articles');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}
