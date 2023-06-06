<?php

namespace App\Controller\Admin;

use App\Entity\Inscreption;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;


class InscreptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inscreption::class;
    }
  
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('user'),
            AssociationField::new('training'),
            DateField::new('dateAdd'),
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
