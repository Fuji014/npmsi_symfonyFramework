<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		
		// $User = new User();
		// $User->setUsername();
		// $User->setEmail();
		// $hash = $encoder->encodePassword($User, 'password');
		// $User->setPassword($hash);
		// $manager->persist($User);
        // $manager->flush();
    }
}
