<?php

namespace App\Controller\Admin;

use App\Entity\Expert;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExpertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Expert::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname'),
            TextField::new('lastname'),
            SlugField::new('slug')->setTargetFieldName('firstname')->hideOnIndex(),
            TextField::new('email')->hideOnIndex(),
            TextField::new('company')->hideOnIndex(),
            TextField::new('country')->hideOnIndex(),
            NumberField::new('phone'),
            AssociationField::new('user')->hideOnIndex(),
            TextareaField::new('biography')->hideOnIndex(),
            ImageField::new('picture')->setBasePath('/assets/images/experts')
            ->setUploadDir('public/assets/images/experts/')->setUploadedFileNamePattern('[randomhash].[extension]'),
            TextField::new('linkedin')->hideOnIndex(),
            TextField::new('twitter')->hideOnIndex(),
            DateField::new('date_add')->hideOnIndex(),
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
