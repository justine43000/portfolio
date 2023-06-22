<?php

namespace App\Controller\Admin;

use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;



class ProjetCrudController extends AbstractCrudController
{
    private $requestStack;
    private $entityManager;

    public static function getEntityFqcn(): string
    {
        return Projet::class;
    }

    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    public function createEntity(string $entityFqcn)
    {
        $projet = new Projet();

        // Ajout des catégories à l'entité Projet
        $categories = $projet->getCategorie();
        foreach ($categories as $categorie) {
            $projet->addCategorie($categorie);
        }

        return $projet;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Projets')
            ->setEntityLabelInSingular('Projet')
            ->setPageTitle('index', 'Administration des projets');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom');
        yield TextField::new('lien');
        yield TextareaField::new('difficultes')
            ->setRequired(true);
        yield AssociationField::new('categorie')
            ->setFormTypeOptionIfNotSet('by_reference', false)
            /*->setFormTypeOptions([
                'multiple' => true,
                'expanded' => true,
                'class' => Categorie::class,
                'choice_label' => 'label',
            ])*/
            // ->setDefaultQuery(function (QueryBuilder $qb) {
            //     return $qb->orderBy('c.label', 'ASC');
            // })
            ->setRequired(true);

        yield ImageField::new('imageName')
            ->setBasePath('uploads/projets/')
            ->setUploadDir('public/uploads/projets/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(true);
    }
}
