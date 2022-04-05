<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CandidateRegisrterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CandidateRegisterController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/candidate-register', name: 'app_candidate_register')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher ): Response
    {

        $user = new User();
        $form = $this->createForm(CandidateRegisrterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $password = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            $em = $this->doctrine->getManager();

            // défini le role de CANDIDATE
            $user->setRoles(['ROLE_CANDIDATE']);

            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'notice',
                'Votre candidature a bien été enregistrée !'
            );

            return $this->redirectToRoute('account');
        }









        return $this->render('candidate_register/index.html.twig', [
            'nomPage' => "Enregistrement candidature",
            'formCandidate'=> $form->createView()
        ]);
    }
}
