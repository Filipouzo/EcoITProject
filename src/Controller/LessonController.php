<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonController extends AbstractController
{
    #[Route(path : '/lesson', name: 'app_lesson')]
    public function index(): Response
    {
        return $this->render('lesson/index.html.twig', [
            'controller_name' => 'LessonController',
        ]);
    }
}
