<?php

namespace App\Service\Crawlers;

class NetBasalCrawler extends AbstractCrawler
{
    private function formatCreationDate($createdAt)
    {
        return \DateTime::createFromFormat('U', strtotime($createdAt));
    }

    private function formatUrl($url)
    {
        return strstr($url, '?', true);
    }

    private function formatImage($image)
    {
        $pattern = '/\((.*?)\)/';
        preg_match($pattern, $image, $matches);

        return str_replace('"', '', $matches[1]);
    }

    public function crawl()
    {
        $this->response->filter('div.u-marginTop15 > div.col')->each(function ($node, $index) {
            $this->articles[$index]['title'] = $node->filter('div.col > a > h3 > div')->text('', true);
            $this->articles[$index]['description'] = $node->filter('div.col > a > div > div')->text('', true);
            $this->articles[$index]['createdAt'] = $this->formatCreationDate($node->filter('div.col > div > div > div.ui-captionStrong > div > time')->attr('datetime'));
            $this->articles[$index]['url'] = $this->formatUrl($node->filter('div.postItem > a')->attr('href'));
            $this->articles[$index]['image'] = $this->formatImage($node->filter('div.postItem > a')->attr('style'));
        });

        return $this->articles;
    }
}
