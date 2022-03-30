<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class RegisterController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route(path: '/register', name: 'app_enregistrement_apprenant')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher ): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $password = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            $em = $this->doctrine->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'notice',
                'Vous êtes maintenant enregistré en tant qu\'apprenant !'
            );

//            return $this->redirectToRoute('/courses');


        }

        return $this->render('register/index.html.twig',[
            'nomPage' => "Connexion",
            'form'=> $form->createView()
        ]);
    }
}
