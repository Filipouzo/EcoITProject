<?php
//
//namespace App\DataFixtures;
//
//use App\Entity\Lesson;
//use Doctrine\Bundle\FixturesBundle\Fixture;
//use Doctrine\Common\DataFixtures\DependentFixtureInterface;
//use Doctrine\Persistence\ObjectManager;
//use Faker;
//
//class LessonFixtures extends Fixture implements DependentFixtureInterface
//{
//    public function getDependencies():array
//    {
//        return [
//            CourseFixtures::class,
//        ];
//    }
//
//    public function load(ObjectManager $manager): void
//    {
//        $faker = Faker\Factory::create('fr_FR');

//        for ($i=0; $i<=3; $i++) {
//            $lesson = new lesson();
//            $content = '<p>'.join($faker->paragraphs(),'</p><p>').'</p>';
//            $lesson     ->setTitle($faker->sentence())
//                        ->setContent ($content)
//                        ;
//            $manager->persist($lesson);
//
//
//            // ->
//            // ->
//
//            //
//        }
//
//
//
//        $manager->flush();
//    }
//}
