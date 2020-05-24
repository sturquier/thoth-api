<?php

namespace App\Service;

use App\Entity\Website;
use App\Service\Crawlers\OctoCrawler;

class CrawlerFactory
{
    public static function makeCrawler(Website $website)
    {
        switch ($website->getSlug()) {
            case 'octo-talks':
                return new OctoCrawler($website);
            default:
                return;
        }
    }
}
