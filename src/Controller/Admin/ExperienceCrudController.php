<?php

namespace App\Controller\Admin;

use App\Entity\Experience;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExperienceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Experience::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Expériences')
            ->setEntityLabelInSingular('Expérience')
            ->setPageTitle('index', 'Administration des expériences');
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nomEntreprise');
        yield DateTimeField::new('dateDebut');
        yield DateTimeField::new('dateFin');
        yield TextareaField::new('description')->setRequired(true);
    }
    
}
