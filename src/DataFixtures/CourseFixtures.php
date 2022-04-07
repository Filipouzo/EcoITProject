<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use app\entity\Course;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
            $nameCourse = [
            "L'éco-conception",
            "L'économie circulaire",
            "Bonnes pratiques",
            "Green IT"
        ];
            $descriptionCourse = [
                "Mais qu'est ce que l'éco-conception en fait ?",
                "l’éco-conception et les piliers de l’économie circulaire",
                "Le guide des bonnes pratiques",
                "les connaissances fondamentales sur le sujet"
            ];

        $imageCourse = [
            'https://cdn.pixabay.com/photo/2021/09/24/00/38/dew-6651074_1280.jpg',
            'https://cdn.pixabay.com/photo/2022/04/04/07/58/seedlings-7110591_1280.jpg',
            'https://cdn.pixabay.com/photo/2016/04/04/14/12/monitor-1307227_1280.jpg',
            'https://cdn.pixabay.com/photo/2016/05/05/11/22/computer-1373684_1280.jpg'
        ];


            for ($i=0; $i<=3; $i++){
                $course= new Course();
                $course ->setName($nameCourse[$i])
                        ->setDescription($descriptionCourse[$i])
                        ->setPicture($imageCourse[$i])
                        ->setCreationDate(new \DateTime())
                ;
                $manager->persist($course);
            }
        $manager->flush();

    }
}
