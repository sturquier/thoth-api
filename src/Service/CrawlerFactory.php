<?php

namespace App\Service;

use App\Entity\Website;
use App\Service\Crawlers\DefaultCrawler;

class CrawlerFactory
{
    public static function makeCrawler(Website $website)
    {
        switch ($website->getSlug()) {
            default:
                return new DefaultCrawler();
        }
    }
}
