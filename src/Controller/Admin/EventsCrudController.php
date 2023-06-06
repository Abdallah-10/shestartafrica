<?php

namespace App\Controller\Admin;

use App\Entity\Events;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class EventsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Events::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            SlugField::new('slug')->setTargetFieldName('title')->hideOnIndex(),
            TextareaField::new('description')->hideOnIndex(),
            ImageField::new('cover')->setBasePath('/assets/images/events')
            ->setUploadDir('public/assets/images/events/')->setUploadedFileNamePattern('[randomhash].[extension]'),
            TextField::new('local'),
            DateField::new('date_start'),
            DateField::new('date_end'),
            TextField::new('category')->hideOnIndex(),
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
