<?php
//
//namespace App\DataFixtures;
//
//use App\Entity\Section;
//use Doctrine\Bundle\FixturesBundle\Fixture;
//use Doctrine\Common\DataFixtures\DependentFixtureInterface;
//use Doctrine\Persistence\ObjectManager;
//use Faker;
//
//class SectionFixtures extends Fixture implements DependentFixtureInterface
//{
//    public function getDependencies():array
//    {
//        return [
//            CourseFixtures::class,
//            LessonFixtures::class
//        ];
//    }
//
//    public function load(ObjectManager $manager): void
//    {
//        $faker = Faker\Factory::create('fr_FR);

//        for ($i=0; $i<=3; $i++) {
//            $section = new Section();
//            $section->setTitle($faker->sentence());
//            $manager->persist($section);
//        }
//
//        $manager->flush();
//    }
//}
