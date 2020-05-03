<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebsiteControllerTest extends WebTestCase
{
    public function testGetWebsites()
    {
        $client = static::createClient();
        $client->request('GET', '/websites');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
