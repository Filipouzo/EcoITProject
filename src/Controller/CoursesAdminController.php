<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursesAdminController extends AbstractController
{
    /**
     * @Route("/coursesAdmin", name="app_gestion_formations")
     */
    public function index(): Response
    {
        return $this->render('courses_admin/index.html.twig',[
            'nomPage' => "Gestion des formations"
        ]);
    }
}
