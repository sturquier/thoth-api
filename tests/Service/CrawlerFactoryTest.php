<?php

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Website;
use App\Service\CrawlerFactory;
use App\Service\Crawlers\LaravelNewsCrawler;
use App\Service\Crawlers\LogRocketCrawler;
use App\Service\Crawlers\NetBasalCrawler;
use App\Service\Crawlers\OctoCrawler;
use App\Service\Crawlers\ScotchCrawler;
use App\Service\Crawlers\TowardsDataScienceCrawler;

class CrawlerFactoryTest extends WebTestCase
{
    protected static $container;
    protected $crawlerFactory;

    protected function setUp(): void
    {
        self::bootKernel();

        self::$container = self::$kernel->getContainer();
        $this->crawlerFactory = new CrawlerFactory();
    }

    protected function tearDown(): void
    {
        self::ensureKernelShutdown();

        self::$kernel = null;
        self::$container = null;
        $this->crawlerFactory = null;
    }

    public function testCrawlerMakingWithWrongWebsite()
    {
        $website = new Website();
        $website->setSlug('lorem-ipsum');

        $this->assertNull($this->crawlerFactory::makeCrawler($website));
    }

    public function testCrawlerMakingWithLaravelNewsWebsite()
    {
        $website = self::$container->get('doctrine')->getRepository(Website::class)->findOneBy(['slug' => 'laravel-news']);

        $this->assertTrue($this->crawlerFactory::makeCrawler($website) instanceof LaravelNewsCrawler);
    }

    public function testCrawlerMakingWithLogRocketWebsite()
    {
        $website = self::$container->get('doctrine')->getRepository(Website::class)->findOneBy(['slug' => 'logrocket']);

        $this->assertTrue($this->crawlerFactory::makeCrawler($website) instanceof LogRocketCrawler);
    }

    public function testCrawlerMakingWithNetBasalWebsite()
    {
        $website = self::$container->get('doctrine')->getRepository(Website::class)->findOneBy(['slug' => 'netbasal']);

        $this->assertTrue($this->crawlerFactory::makeCrawler($website) instanceof NetBasalCrawler);
    }

    public function testCrawlerMakingWithOctoWebsite()
    {
        $website = self::$container->get('doctrine')->getRepository(Website::class)->findOneBy(['slug' => 'octo-talks']);

        $this->assertTrue($this->crawlerFactory::makeCrawler($website) instanceof OctoCrawler);
    }

    public function testCrawlerMakingWithScotchWebsite()
    {
        $website = self::$container->get('doctrine')->getRepository(Website::class)->findOneBy(['slug' => 'scotch-io']);

        $this->assertTrue($this->crawlerFactory::makeCrawler($website) instanceof ScotchCrawler);
    }

    public function testCrawlerMakingWithTowardsDataScienceWebsite()
    {
        $website = self::$container->get('doctrine')->getRepository(Website::class)->findOneBy(['slug' => 'towards-data-science']);

        $this->assertTrue($this->crawlerFactory::makeCrawler($website) instanceof TowardsDataScienceCrawler);
    }
}
