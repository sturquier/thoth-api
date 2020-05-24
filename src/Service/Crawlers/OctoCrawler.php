<?php

namespace App\Service\Crawlers;

class OctoCrawler extends AbstractCrawler
{
    private function formatCreationDate($createdAt)
    {
        return \DateTime::createFromFormat('U', strtotime($createdAt));
    }

    public function crawl()
    {
        $this->response->filter('article.article-resume')->each(function ($node, $index) {
            $this->articles[$index]['title'] = $node->filter('h2.post-heading > a.post-heading-link')->text('', true);
            $this->articles[$index]['description'] = $node->filter('div.entry-content > p')->text('', true);
            $this->articles[$index]['createdAt'] = $this->formatCreationDate($node->filter('div.post-meta > time')->attr('datetime'));
            $this->articles[$index]['url'] = $node->filter('h2.post-heading > a.post-heading-link')->attr('href');
            $this->articles[$index]['image'] = $node->filter('div.entry-content > div.head-pic > img')->image()->getUri();
        });

        return $this->articles;
    }
}
