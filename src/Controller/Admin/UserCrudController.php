<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Flex\Response;


class UserCrudController extends AbstractCrudController
{


    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    // Ajout d'un filtre qui va permettre de trier par CANDIDATE ou INSTRUCTOR
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('roles', null, ['label' => 'Rôles']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            ImageField::new('profilepicture', 'Photo')
                ->setBasePath('uploads/picture')
                ->setUploadDir('public/uploads/picture')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('firstName', 'Prénom'),
            TextField::new('lastName', 'Nom'),
            TextField::new('email', 'Email'),
            TextField::new('password','mot de passe'),
            TextareaField::new('description', 'Description'),
            BooleanField::new('isAccepted', 'candidature traitée'),
            ChoiceField::new('roles', 'Rôle')
                ->setChoices([
                'Instructeur' => 'ROLE_INSTRUCTOR',
                'Candidat' => 'ROLE_CANDIDATE',
                'Apprenant'=> 'ROLE_STUDENT',
                'Administrateur'=>'ROLE_ADMIN'
                ])
                ->allowMultipleChoices()
                ->renderExpanded()
        ];
    }

}