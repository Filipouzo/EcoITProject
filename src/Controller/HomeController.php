<?php

namespace App\Controller;

use App\Entity\Course;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route(path: '/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine) {
        $repository = $doctrine->getRepository(persistentObject: Course::class);
        $courses = $repository->findLastCourses();
        return $this->render('Home/index.html.twig',[
            'courses' => $courses,
            'nomPage' => "Accueil"
        ]);
}


}