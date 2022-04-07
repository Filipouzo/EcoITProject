<?php

namespace App\Controller;

use App\Entity\Course;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursesController extends AbstractController
{


    #[Route(path :'/courses', name: 'courses')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(persistentObject: Course::class);
        $courses = $repository->findBy([]);
        return $this->render('courses/index.html.twig',[
            'courses' => $courses,
            'nomPage' => "Liste des formations"
        ]);
    }

    #[Route(path :'/courses/{id}', name: 'app_course_show')]
    public function show($id, ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(persistentObject: Course::class);
        $course = $repository->find($id);
        return $this->render ('courses/show.html.twig',[
            'course' => $course,
            'nomPage' => "Formation"
        ]);
    }
}
