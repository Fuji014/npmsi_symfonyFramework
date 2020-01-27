<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // for ($z = 1; $z <= 3; $z++)
		//  {
		//  	$Article = new Article();
		//  	$Article->setTitle("Article number ".$z);
		//  	$Article->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
		//  	$Article->setImage("http://placehold.it/1000x200");
		//  	$Article->setCreatedAt(new \DateTime());
		//  	$manager->persist($Article);
		//  }

        $manager->flush();
    }
}
