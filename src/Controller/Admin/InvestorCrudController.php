<?php

namespace App\Controller\Admin;

use App\Entity\Investor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class InvestorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Investor::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
			SlugField::new('slug')->setTargetFieldName('title')->hideOnIndex(),
			TextField::new('type'),
            TextareaField::new('description')->hideOnIndex(),
            ImageField::new('logo')->setBasePath('/assets/images/investors')
            ->setUploadDir('public/assets/images/investors/')->setUploadedFileNamePattern('[randomhash].[extension]'),
            TextField::new('field'),
            TextField::new('category'),
            TextField::new('country'),
            TextField::new('linkedin')->hideOnIndex(),
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
