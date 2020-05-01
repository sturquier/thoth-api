<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Website;

class WebsiteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $websites = [
        [
            'name'      => 'CSS Tricks',
            'url'       => 'https://css-tricks.com/archives/'
        ],
        [
            'name'      => 'CodeBurst',
            'url'       => 'https://codeburst.io/'
        ],
        [
            'name'      => 'Hackernoon',
            'url'       => 'https://hackernoon.com/tagged/coding/'
        ],
        [
            'name'      => 'Laravel News',
            'url'       => 'https://laravel-news.com/blog'
        ],
        [
            'name'      => 'LinuxTechLab',
            'url'       => 'https://linuxtechlab.com/'
        ],
        [
            'name'      => 'LogRocket',
            'url'       => 'https://blog.logrocket.com/'
        ],
        [
            'name'      => 'NetBasal',
            'url'       => 'https://netbasal.com/'
        ],
        [
            'name'      => 'Octo Talks',
            'url'       => 'https://blog.octo.com/'
        ],
        [
            'name'      => 'Putain de Code',
            'url'       => 'https://putaindecode.io/articles'
        ],
        [
            'name'      => 'Scotch.io',
            'url'       => 'https://scotch.io/tutorials'
        ],
        [
            'name'      => 'Think To Code',
            'url'       => 'https://thinktocode.com/'
        ],
        [
            'name'      => 'Towards Data Science',
            'url'       => 'https://towardsdatascience.com/'
        ]];

        foreach ($websites as $ws) {
            $website = new Website();
            $website->setName($ws['name']);
            $website->setUrl($ws['url']);

            $manager->persist($website);
        }

        $manager->flush();
    }
}
