<?php

namespace App\Service\Crawlers;

use Goutte\Client;
use App\Entity\Website;

abstract class AbstractCrawler
{
    protected $articles;
    protected $client;
    protected $response;
    protected $website;

    public function __construct(Website $website)
    {
        $this->articles = [];
        $this->client = new Client();
        $this->website = $website;

        $this->setResponse();
    }

    private function setResponse()
    {
        $this->response = $this->client->request('GET', $this->website->getUrl());

        return $this;
    }

    abstract protected function crawl();
}
