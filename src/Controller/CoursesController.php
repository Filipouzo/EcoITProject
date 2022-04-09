<?php

namespace App\Controller;

use App\Entity\Course;
use App\Repository\CourseRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursesController extends AbstractController
{
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

    #[Route(path :'/courses/{id}', name: 'app_course_show')]
    public function show(Course $course){
        return $this->render ('courses/show.html.twig',[
            'course' => $course,
            'nomPage' => "Formation"
        ]);
    }
}
