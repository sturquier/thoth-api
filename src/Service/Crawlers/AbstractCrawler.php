<?php

namespace App\Service\Crawlers;

use Goutte\Client;
use App\Entity\Website;

abstract class AbstractCrawler
{
    protected $client;
    protected $articles;
    protected $response;

    public function __construct(Website $website)
    {
        $this->client = new Client();
        $this->articles = [];

        $this->setResponse($website);
    }

    private function setResponse(Website $website)
    {
        $this->response = $this->client->request('GET', $website->getUrl());

        return $this;
    }

    abstract protected function crawl();
}
