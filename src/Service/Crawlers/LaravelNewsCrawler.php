<?php

namespace App\Service\Crawlers;

class LaravelNewsCrawler extends AbstractCrawler
{
    private function formatCreationDate($createdAt)
    {
        $date = trim(substr($createdAt, strpos($createdAt, '/') + 1));

        return \DateTime::createFromFormat('U', strtotime($date));
    }

    private function formatUrl($url)
    {
        return strstr($this->website->getUrl(), '/blog', true).$url;
    }

    private function formatImage($image)
    {
        return strstr($image, '?', true);
    }

    public function crawl()
    {
        $this->response->filter('div.card--post')->each(function ($node, $index) {
            $this->articles[$index]['title'] = $node->filter('div.prose > h2 > a')->text('', true);
            $this->articles[$index]['description'] = $node->filter('div.prose > p')->text('', true);
            $this->articles[$index]['createdAt'] = $this->formatCreationDate($node->filter('div.prose > span')->text('', true));
            $this->articles[$index]['url'] = $this->formatUrl($node->filter('div.post__image > a')->attr('href'));
            $this->articles[$index]['image'] = $this->formatImage($node->filter('div.post__image > a > img')->image()->getUri());
        });

        return $this->articles;
    }
}
