<?php

namespace App\Controller;

use App\Repository\CourseRepository;
use App\Repository\SectionRepository;
use App\Repository\LessonRepository;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CoursesController extends AbstractController
{
//    private $entityManager;
//
//    public function __construct(EntityManagerInterface $entityManager)
//    {
//        $this->entityManager = $entityManager;
//    }

    //Affichage de tous les cours par ordre de création
    #[Route(path :'/courses', name: 'courses')]
    public function index(CourseRepository $repo,ManagerRegistry $doctrine): Response { //injection de dépendances du Course repository
            $courses = $repo->findDESC();
        return $this->render('courses/index.html.twig',[
            'courses' => $courses,
            'nomPage' => "Liste des formations"
        ]);
    }

//    #[Route(path :'/courses/{id}', name: 'app_course_show')]
//    public function show(CourseRepository $repo, $id, ManagerRegistry $doctrine): Response {
//        $course = $repo->find($id);
//        return $this->render ('courses/show.html.twig',[
//            'course' => $course,
//            'nomPage' => "Formation"
//        ]);
//    }


    //Affichage du cours avec l'id demandé
//    #[Route(path :'/courses/{id}', name: 'app_course_show')]
//    public function show(Course $course, SectionRepository $sections, LessonRepository $lessons, $id){
////        Les sections du cours
//        $sections = $course->getSection();
////        Les leçons de chacune des sections
//        foreach ($sections as $section) { $lessons = $section->getLessons();}
//
//        return $this->render ('courses/show.html.twig',[
//            'nomPage' => "Formation",
//            'course' => $course,
//            'sections' => $sections,
//            'lessons' => $lessons
//        ]);

        //Affichage du cours avec l'id demandé
        #[Route(path :'/courses/{idCourse}', name: 'app_course_show')]
    public function show(CourseRepository $courseRepository, SectionRepository $sections, $idCourse, LessonRepository $lessons){

            $course = $courseRepository->find($idCourse);
//        Les sections du cours
            $sections = $course->getSection();
//        Les leçons de chacune des sections et une liste de leurs id
            $idLesson ="";
            $listId = [];
            foreach ($sections as $section) {
                $lessons = $section->getLessons();

                foreach ($lessons as $lesson) {
                    $idLesson = $lesson->getId();
                    $listId[] = $idLesson;
                }
            }

            return $this->render ('courses/show.html.twig',[
                'nomPage' => "Formation",
                'course' => $course,
                'sections' => $sections,
                'lessons' => $lessons,
                'listId' => $listId
            ]);



    }
}
