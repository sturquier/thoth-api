<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

class CrawlerControllerTest extends AbstractControllerTest
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
        $this->client->request('POST', '/crawl');

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequestWithWrongPayload()
    {
        $this->login();

        $slug = 'lorem-ipsum';
        $this->client->request('POST', '/crawl', [
            'slug' => $slug
        ]);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequestWithRightPayload()
    {
        $this->login();

        $slug = 'octo-talks';
        $this->client->request('POST', '/crawl', [
            'slug' => $slug
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }
}
