<?php

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Website;
use App\Service\CrawlerFactory;
use App\Service\Crawlers\OctoCrawler;
use App\Service\Crawlers\ScotchCrawler;

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
}
