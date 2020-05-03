<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testGetArticles()
    {
        $client = static::createClient();
        $client->request('GET', '/articles');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
