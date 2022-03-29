<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursesController extends AbstractController
{
    #[Route('/courses', name: 'app_formations')]
    public function index(): Response
    {
        return $this->render('courses/index.html.twig',[
            'nomPage' => "Liste des formations"
        ]);
    }
}
