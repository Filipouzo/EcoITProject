<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use App\Entity\Section;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use app\entity\Course;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CourseFixtures extends Fixture
{

    public function __construct( private UserPasswordHasherInterface $passwordEncoder){}

        public function load(ObjectManager $manager): void
    {



        $faker = Faker\Factory::create('fr_FR');

        for ($h=0; $h<=3; $h++) {
            $fakeStudent = new User();
            $fakeStudent
                ->setEmail($faker->email)
                ->setPassword($this->passwordEncoder->hashPassword($fakeStudent, 'etudiant'))
                ->setRoles(['ROLE_STUDENT'])
                ->setDescription("Je suis un étudiant!")
                ->setNickname($faker->firstName)
                ;
        }


        for ($i=0; $i<=3; $i++) {
            $fakeInstructor = new User();
            $fakeInstructor
                ->setEmail($faker->email)
                ->setPassword($this->passwordEncoder->hashPassword($fakeInstructor, 'instructeur'))
                ->setRoles(['ROLE_INSTRUCTOR'])
                ->setDescription("Je suis un formateur !")
                ->setProfilepicture($faker->imageUrl())
                ->setIsAccepted(True)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName);

            $manager->persist($fakeInstructor);


            $nameCourse = [
                "L'éco-conception",
                "L'économie circulaire",
                "Bonnes pratiques",
                "Green IT"
            ];
            $descriptionCourse = [
                "Mais qu'est ce que l'éco-conception ?",
                "Les piliers de l’économie circulaire",
                "Le guide des bonnes pratiques",
                "Les connaissances fondamentales sur le sujet"
            ];

            $imageCourse = [
                'https://cdn.pixabay.com/photo/2021/09/24/00/38/dew-6651074_1280.jpg',
                'https://cdn.pixabay.com/photo/2022/04/04/07/58/seedlings-7110591_1280.jpg',
                'https://cdn.pixabay.com/photo/2016/04/04/14/12/monitor-1307227_1280.jpg',
                'https://cdn.pixabay.com/photo/2016/05/05/11/22/computer-1373684_1280.jpg'
            ];

            $course= new Course();
            $course ->setName($nameCourse[$i])
                    ->setDescription($descriptionCourse[$i])
                    ->setPicture($imageCourse[$i])
                    ->setCreationDate($faker->dateTimeBetween('-1 year'))
                    ->setIsCreatedBy($fakeInstructor)
            ;
            $manager->persist($course);


            for ($j=1; $j<=mt_rand(1,3); $j++) {
                $section = new Section();
                $section
                        ->setTitle('Section '.$j)
                        ->setCourse($course)
                ;
                $manager->persist($section);

                for ($k=1; $k<=mt_rand(1,4); $k++) {
                    $lesson = new lesson();
                    $lesson
                        ->setTitle('Leçon N°'.$k)
                        ->setContent('dedededededede' )
                        ->setSection($section)
//                        ->setIsCheckedBy($fakeStudent)
                    ;
                    $manager->persist($lesson);
                }
            }
        }
        $manager->flush();
    }


}
