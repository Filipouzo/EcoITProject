<?php

namespace App\Form;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CandidateRegisrterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => true,
                'label' => 'Votre prénom',
                'constraints' => new Length(min:2 , max: 30),
                'attr' => [
                    'placeholder' => 'prénom'
                ]
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
                'label' => 'Votre nom',
                'constraints' => new Length(min:2 , max: 30),
                'attr' => [
                    'placeholder' => 'nom'
                ]
            ])

            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'Décrivez ici vos spécialités',
                'constraints' => new Length(min:5 , max: 300),
                'attr' => [
                    'placeholder' => 'nom'
                ]
            ])

            ->add('profilepicture', FileType::class, [

                'required' => false,
                'label' => 'Ajouter une Photo de profil'
            ])

            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Votre Email',
                'constraints' => new Length(min:2 , max: 30),
                'attr' => [
                    'placeholder' => 'mail'
                ]
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être ideniques.',
                'label' => 'Votre mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmation mot de passe'
                    ]
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer ma candidature'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
