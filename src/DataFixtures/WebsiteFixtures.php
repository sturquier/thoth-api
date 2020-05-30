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
            'name' => 'CSS Tricks',
            'url' => 'https://css-tricks.com/archives'
        ],
        [
            'name' => 'CodeBurst',
            'url' => 'https://codeburst.io'
        ],
        [
            'name' => 'Laravel News',
            'url' => 'https://laravel-news.com/blog'
        ],
        [
            'name' => 'LogRocket',
            'url' => 'https://blog.logrocket.com'
        ],
        [
            'name' => 'NetBasal',
            'url' => 'https://netbasal.com'
        ],
        [
            'name' => 'Octo Talks',
            'url' => 'https://blog.octo.com'
        ],
        [
            'name' => 'Scotch.io',
            'url' => 'https://scotch.io'
        ],
        [
            'name' => 'Towards Data Science',
            'url' => 'https://towardsdatascience.com/latest'
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
