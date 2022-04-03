<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user   ->setEmail("utilisateur@exemple.com")
            ->setPassword("utilisateur")
            ->setRoles(['ROLE_USER'])
            ->setNickname("pseudo");
        $manager->persist($user);

        $admin = new User();
        $admin   ->setEmail("admin@exemple.com")
                ->setPassword("admin")
                ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $instructor = new User();
        $instructor ->setEmail("instructeur@exemple.com")
                    ->setPassword("instructeur")
                    ->setRoles(['ROLE_INSTRUCTOR'])
                    ->setDescription("J'en ai rêvé, je suis maintenant instructeur !")
//                  ->setProfilepicture("4899f85413a740cda66a8ae328747125d960fb38.jpg")
                    ->setIsAccepted(true)
                    ->setFirstName("John")
                    ->setLastName("Doe");

        $manager->persist($instructor);

        $candidate = new User();
        $candidate ->setEmail("candidate@exemple.com")
            ->setPassword("candidate")
            ->setRoles(['ROLE_USER'])
            ->setDescription("depuis tout petit, je rêve d'être instructeur !")
//                  ->setProfilepicture("4899f85413a740cda66a8ae328747125d960fb38.jpg")
            ->setIsAccepted(false)
            ->setFirstName("Elon")
            ->setLastName("Musk");

        $manager->persist($candidate);




        $manager->flush();
    }
}
