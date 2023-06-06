<?php

namespace App\Controller\Admin;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }
  

    public function configureFields(string $pageName): iterable
    {
        return [
          
            TextField::new('title'),
            SlugField::new('slug')->setTargetFieldName('title')->hideOnIndex(),
            TextareaField::new('description')->hideOnIndex(),
            ImageField::new('cover')->setBasePath('/assets/images/news')
            ->setUploadDir('public/assets/images/news/')->setUploadedFileNamePattern('[randomhash].[extension]'),
            DateField::new('date_add'),
            TextField::new('author')->hideOnIndex(),
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
