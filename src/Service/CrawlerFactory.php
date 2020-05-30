<?php

namespace App\Service;

use App\Entity\Website;
use App\Service\Crawlers\CodeBurstCrawler;
use App\Service\Crawlers\CSSTricksCrawler;
use App\Service\Crawlers\LaravelNewsCrawler;
use App\Service\Crawlers\LogRocketCrawler;
use App\Service\Crawlers\NetBasalCrawler;
use App\Service\Crawlers\OctoCrawler;
use App\Service\Crawlers\ScotchCrawler;
use App\Service\Crawlers\TowardsDataScienceCrawler;

class CrawlerFactory
{
    public static function makeCrawler(Website $website)
    {
        switch ($website->getSlug()) {
            case 'codeburst':
                return new CodeBurstCrawler($website);
            case 'css-tricks':
                return new CSSTricksCrawler($website);
            case 'laravel-news':
                return new LaravelNewsCrawler($website);
            case 'logrocket':
                return new LogRocketCrawler($website);
            case 'netbasal':
                return new NetBasalCrawler($website);
            case 'octo-talks':
                return new OctoCrawler($website);
            case 'scotch-io':
                return new ScotchCrawler($website);
            case 'towards-data-science':
                return new TowardsDataScienceCrawler($website);
            default:
                return;
        }
    }
}
