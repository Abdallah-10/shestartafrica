<?php

namespace App\Controller\Admin;

use App\Entity\Mentor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MentorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mentor::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            TextareaField::new('description')->hideOnIndex(),
            TextField::new('occupation'),
            TextField::new('localisation'),
            ArrayField::new('skills'),
            TextField::new('speciality'),
            DateField::new('date_add'),
            ImageField::new('cover')->setBasePath('/assets/images/mentors')
            ->setUploadDir('public/assets/images/mentors/')->setUploadedFileNamePattern('[randomhash].[extension]'),
            ArrayField::new('programs'),
            TextField::new('linkedin')->hideOnIndex(),
            TextField::new('mail')->hideOnIndex(),
            Field::new('status'),
        ];
    }
     public function configureActions(Actions $actions): Actions
     {
        $actions = parent::configureActions($actions);
        $actions->add(Crud::PAGE_INDEX, Action::new('show', 'show')->linkToCrudAction(Action::DETAIL));

        return $actions;
     }
    
}
