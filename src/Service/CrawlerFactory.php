<?php

namespace App\Service;

use App\Entity\Website;
use App\Service\Crawlers\OctoCrawler;
use App\Service\Crawlers\ScotchCrawler;

class CrawlerFactory
{
    public static function makeCrawler(Website $website)
    {
        switch ($website->getSlug()) {
            case 'octo-talks':
                return new OctoCrawler($website);
            case 'scotch-io':
                return new ScotchCrawler($website);
            default:
                return;
        }
    }
}
