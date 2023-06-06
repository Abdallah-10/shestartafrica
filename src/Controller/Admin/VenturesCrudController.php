<?php

namespace App\Controller\Admin;

use App\Entity\Ventures;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VenturesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ventures::class;
    }

  
    public function configureFields(string $pageName): iterable
    {
        
        return [
            TextField::new('title'),
            SlugField::new('slug')->setTargetFieldName('title')->hideOnIndex(),
            DateField::new('years')->setFormat('yyyy'),
            TextField::new('category')->hideOnIndex(),
            TextField::new('country'),
            TextField::new('sector'),
            ImageField::new('cover')->setBasePath('/assets/images/ventures')
            ->setUploadDir('public/assets/images/ventures/')->setUploadedFileNamePattern('[randomhash].[extension]'),
           
            ImageField::new('flag')->setLabel('logo')->setBasePath('/assets/images/ventures')
            ->setUploadDir('public/assets/images/ventures/')->setUploadedFileNamePattern('[randomhash].[extension]'),
            TextareaField::new('description')->hideOnIndex(),
            TextField::new('linkedIn')->hideOnIndex(),
            TextField::new('mail')->hideOnIndex(),
            TextField::new('facebook')->hideOnIndex(),
            Field::new('status'),
        ];
    }
   public function configureFilters(Filters $filters): Filters
   {
    return $filters
    ->add('title')
    ->add('years')
    ->add('country')
    ->add('category')
    ->add('status');
   }
   public function configureActions(Actions $actions): Actions
    {
        $actions = parent::configureActions($actions);
        $actions->add(Crud::PAGE_INDEX, Action::new('show', 'show')->linkToCrudAction(Action::DETAIL));

        return $actions;
    }
}
