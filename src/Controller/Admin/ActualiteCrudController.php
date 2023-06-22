<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ActualiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actualite::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Actualités')
            ->setEntityLabelInSingular('Actualité')
            ->setPageTitle('index', 'Administration des actualités');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom');
        yield DateTimeField::new('date');
        yield TextField::new('lieu');
        yield TextareaField::new('description')->setRequired(true);
        yield ImageField::new('image')
            ->setBasePath('/uploads/actualites')
            ->setUploadDir('public/uploads/actualites/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(true);
    }
}
