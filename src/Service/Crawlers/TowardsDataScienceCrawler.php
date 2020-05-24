<?php

namespace App\Service\Crawlers;

class TowardsDataScienceCrawler extends AbstractCrawler
{
    private function formatCreationDate($createdAt)
    {
        return \DateTime::createFromFormat('U', strtotime($createdAt));
    }

    private function formatUrl($url)
    {
        return strstr($url, '?', true);
    }

    public function crawl()
    {
        $this->response->filter('div.js-postListHandle > div.js-block > div.postArticle')->each(function ($node, $index) {
            $this->articles[$index]['title'] = $node->filter('div.postArticle-content > a > section > div.section-content > div.section-inner > h3')->text('', true);
            $this->articles[$index]['description'] = $node->filter('div.postArticle-content > a > section > div.section-content > div.section-inner > h4')->text('', true);
            $this->articles[$index]['createdAt'] = $this->formatCreationDate($node->filter('div.u-clearfix > div.postMetaInline > div.u-flexCenter > div.postMetaInline > div.ui-caption > a > time')->attr('datetime'));
            $this->articles[$index]['url'] = $this->formatUrl($node->filter('div.postArticle-content > a')->attr('href'));
            $this->articles[$index]['image'] = null; // Lazy loading
        });

        return $this->articles;
    }
}
