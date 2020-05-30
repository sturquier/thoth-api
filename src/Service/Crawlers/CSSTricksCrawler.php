<?php

namespace App\Service\Crawlers;

class CSSTricksCrawler extends AbstractCrawler
{
    private function formatDescription($node)
    {
        $description = null;

        foreach ($node->extract(['_text']) ?? [] as $text) {
            $description .= $text;
        }

        return $description;
    }

    private function formatCreationDate($createdAt)
    {
        return \DateTime::createFromFormat('Y-m-d', $createdAt);
    }

    public function crawl()
    {
        $this->response->filter('div.articles > article')->each(function ($node, $index) {
            $this->articles[$index]['title'] = $node->filter('div.article-article > h2')->text('', true);
            $this->articles[$index]['description'] = $this->formatDescription($node->filter('div.article-article > div.article-content > p'));
            $this->articles[$index]['createdAt'] = $this->formatCreationDate($node->filter('div.article-article > header > time')->attr('datetime'));
            $this->articles[$index]['url'] = $node->filter('div.article-article > h2 > a')->attr('href');
            $this->articles[$index]['image'] = null;
        });

        return $this->articles;
    }
}
