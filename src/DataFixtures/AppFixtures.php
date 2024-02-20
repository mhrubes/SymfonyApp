<?php

namespace App\DataFixtures;

use App\Entity\Userdata;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        
        $user = new Userdata();
        $user->setFirstname("Martin");
        $user->setLastname("Hrubeš");
        $user->setPassword("test123");        
        $manager->persist($user);

        $user2 = new Userdata();
        $user2->setFirstname("David");
        $user2->setLastname("Hof");
        $user2->setPassword("..-.");        
        $manager->persist($user2);

        $user3 = new Userdata();
        $user3->setFirstname("Honza");
        $user3->setLastname("Benez");
        $user3->setPassword("a.s");        
        $manager->persist($user3);
        
        $manager->flush();
    }
}
