<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct( private UserPasswordHasherInterface $passwordEncoder)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user       ->setEmail("utilisateur@exemple.com")
            ->setPassword($this->passwordEncoder->hashPassword($user, 'user'))
                    ->setRoles(['ROLE_USER'])
                    ->setNickname("pseudo");
        $manager->persist($user);

        $admin = new User();
        $admin      ->setEmail("admin@exemple.com")
                    ->setPassword($this->passwordEncoder->hashPassword($admin, 'admin'))
                    ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $instructor = new User();
        $instructor ->setEmail("instructeur@exemple.com")
            ->setPassword($this->passwordEncoder->hashPassword($instructor, 'instructeur'))
                    ->setRoles(['ROLE_INSTRUCTOR'])
                    ->setDescription("J'en avais rêvé, je suis maintenant instructeur !")
//                  ->setProfilepicture("4899f85413a740cda66a8ae328747125d960fb38.jpg")
                    ->setIsAccepted(true)
                    ->setFirstName("John")
                    ->setLastName("Doe");
        $manager->persist($instructor);

        $candidate = new User();
        $candidate  ->setEmail("candidate@exemple.com")
            ->setPassword($this->passwordEncoder->hashPassword($candidate, 'candidat'))
                    ->setRoles(['ROLE_CANDIDATE'])
                    ->setDescription("depuis tout petit, je rêve d'être instructeur !")
//                  ->setProfilepicture("4899f85413a740cda66a8ae328747125d960fb38.jpg")
                    ->setIsAccepted(false)
                    ->setFirstName("Elon")
                    ->setLastName("Musk");
        $manager->persist($candidate);




        $manager->flush();
    }
}
