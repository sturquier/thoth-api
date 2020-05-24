<?php

namespace App\Service\Crawlers;

class LogRocketCrawler extends AbstractCrawler
{
    private function formatCreationDate($createdAt)
    {
        return \DateTime::createFromFormat('U', strtotime($createdAt));
    }

    private function formatImage($image)
    {
        $pattern = '/\((.*?)\)/';
        preg_match($pattern, $image, $matches);

        return str_replace('"', '', $matches[1]);
    }

    public function crawl()
    {
        $this->response->filter('div.masonrygrid > div.grid-item > div.card')->each(function ($node, $index) {
            $this->articles[$index]['title'] = $node->filter('div.card-block > h2 > a')->text('', true);
            $this->articles[$index]['description'] = $node->filter('div.card-block > span')->text('', true);
            $this->articles[$index]['createdAt'] = $this->formatCreationDate($node->filter('div.card-block > div.metafooter > div.wrapfooter > span.author-meta > span.post-date')->text('', true));
            $this->articles[$index]['url'] = $node->filter('div.card-block > h2 > a')->attr('href');
            $this->articles[$index]['image'] = $this->formatImage($node->filter('a')->attr('style'));
        });

        return $this->articles;
    }
}
