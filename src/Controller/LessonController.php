<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CourseRepository;
use App\Repository\LessonRepository;


class LessonController extends AbstractController
{
    #[Route(path : '/courses/{idLesson}', name: 'app_lesson')]
    public function index(CourseRepository $courseRepository,LessonRepository $lessonRepository, $idLesson): Response
    {
//        $course = $courseRepository->find($idCourse);
        $lesson = $lessonRepository->find($idLesson);
        return $this->render('lesson/index.html.twig', [
//            'course' => $course,
            'lesson' => $lesson
        ]);
    }

}

