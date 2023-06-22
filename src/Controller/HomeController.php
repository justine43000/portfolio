<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Repository\ActualiteRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FormationRepository;
use App\Repository\ProjetRepository;
use App\Repository\TemoignageRepository;
use Doctrine\Migrations\Tools\Console\ConsoleLogger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        ProjetRepository $projetRepository,
        ActualiteRepository $actualiteRepository,
        FormationRepository $formationRepository,
        ExperienceRepository $experienceRepository,
        TemoignageRepository $temoignageRepository
    ): Response {
        $temoignages = $temoignageRepository->findAll();

        if (!empty($temoignages)) {
            return $this->render('home/index.html.twig', [
                'projets' => $projetRepository->lastThree(),
                'experiences' => $experienceRepository->lastThree(),
                'formations' => $formationRepository->lastThree(),
                'actualites' => $actualiteRepository->lastThree(),
                'categories' => $projetRepository->createQueryBuilder('projet')
                    ->leftJoin('projet.categorie', 'categorie')
                    ->addSelect('categorie')
                    ->getQuery()
                    ->getResult(),
                'temoignages' => $temoignages,
            ]);
        } else {
            return $this->render('home/index.html.twig', [
                'projets' => $projetRepository->lastThree(),
                'experiences' => $experienceRepository->lastThree(),
                'formations' => $formationRepository->lastThree(),
                'actualites' => $actualiteRepository->lastThree(),
                'categories' => $projetRepository->createQueryBuilder('projet')
                    ->leftJoin('projet.categorie', 'categorie')
                    ->addSelect('categorie')
                    ->getQuery()
                    ->getResult(),
            ]);
        }
    }
}
