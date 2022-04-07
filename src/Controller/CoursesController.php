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

//    public function index(): Response
//    {
//        return $this->render('courses/index.html.twig',[
//            'nomPage' => "Liste des formations"
//        ]);
//    }



    public function index(ManagerRegistry $doctrine) {
        $repository = $doctrine->getRepository(persistentObject: Course::class);
        $courses = $repository->findBy([]);
        return $this->render('courses/index.html.twig',[
            'courses' => $courses,
            'nomPage' => "Liste des formations"
        ]);
    }

    #[Route(path :'/courses/12', name: 'course_show')]
    public function show(){
        return $this->render ('courses/show.html.twig');
    }

}
