<?php

namespace App\Service\Crawlers;

class CodeBurstCrawler extends AbstractCrawler
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
        $this->response->filter('div.row > div.u-size4of12')->each(function ($node, $index) {
            $this->articles[$index]['title'] = $node->filter('div.col > a > h3 > div.u-fontSize24')->text('', true);
            $this->articles[$index]['description'] = $node->filter('div.col > a > div.u-contentSansThin > div.u-fontSize18')->text('', true);
            $this->articles[$index]['createdAt'] = $this->formatCreationDate($node->filter('div.col > div.u-clearfix > div.u-flexCenter > div.postMetaInline > div.ui-caption > time')->attr('datetime'));
            $this->articles[$index]['url'] = $this->formatUrl($node->filter('div.col > a')->attr('href'));
            $this->articles[$index]['image'] = $this->formatImage($node->filter('div.postItem > a')->attr('style'));
        });

        return $this->articles;
    }
}
