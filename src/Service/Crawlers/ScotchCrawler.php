<?php

namespace App\Service\Crawlers;

class ScotchCrawler extends AbstractCrawler
{
    private function formatCreationDate($createdAt)
    {
        return \DateTime::createFromFormat('U', strtotime($createdAt));
    }

    private function formatUrl($url)
    {
        return $this->website->getUrl().$url;
    }

    public function crawl()
    {
        $this->response->filter('div.blogroll-card')->each(function ($node, $index) {
            $this->articles[$index]['title'] = $node->filter('div.content > h2 > a')->text('', true);
            $this->articles[$index]['description'] = $node->filter('div.content > p')->text('', true);
            $this->articles[$index]['createdAt'] = $this->formatCreationDate($node->filter('div.content > div.byline > div.meta > time')->attr('datetime'));
            $this->articles[$index]['url'] = $this->formatUrl($node->filter('div.content > h2 > a')->attr('href'));
            $this->articles[$index]['image'] = $node->filter('div.image > a > img')->attr('data-src');
        });

        return $this->articles;
    }
}
