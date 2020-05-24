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

    public function testAuthorizedRequestWithWrongWebsite()
    {
        $this->login();

        $slug = 'lorem-ipsum';
        $this->client->request('POST', '/crawl', [
            'slug' => $slug
        ]);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequestWithLaravelNewsWebsite()
    {
        $this->login();

        $slug = 'laravel-news';
        $this->client->request('POST', '/crawl', [
            'slug' => $slug
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequestWithLogRocketWebsite()
    {
        $this->login();

        $slug = 'logrocket';
        $this->client->request('POST', '/crawl', [
            'slug' => $slug
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequestWithNetBasalWebsite()
    {
        $this->login();

        $slug = 'netbasal';
        $this->client->request('POST', '/crawl', [
            'slug' => $slug
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequestWithOctoWebsite()
    {
        $this->login();

        $slug = 'octo-talks';
        $this->client->request('POST', '/crawl', [
            'slug' => $slug
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequestWithScotchWebsite()
    {
        $this->login();

        $slug = 'scotch-io';
        $this->client->request('POST', '/crawl', [
            'slug' => $slug
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }

    public function testAuthorizedRequestWithTowardsDataScienceWebsite()
    {
        $this->login();

        $slug = 'towards-data-science';
        $this->client->request('POST', '/crawl', [
            'slug' => $slug
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }
}
