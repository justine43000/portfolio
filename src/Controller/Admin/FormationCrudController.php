<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Formations')
            ->setEntityLabelInSingular('Formation')
            ->setPageTitle('index', 'Administration des formations');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom');
        yield TextField::new('date');
        yield TextareaField::new('description')->setRequired(true);
    }
}
