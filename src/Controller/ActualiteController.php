<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Repository\ActualiteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualiteController extends AbstractController
{
    #[Route('/actualites', name: 'actualites', methods: ['GET'])]
    public function actualites(
        ActualiteRepository $actualiteRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $actualiteRepository->findAll();

        $actualites = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1)
        );

        return $this->render('actualite/actualites.html.twig', [
            'actualites' => $actualites,
        ]);
    }

    // public function show(Actualite $actualite)
    // {
    //     $date = $actualite->getDate();

    //     // Formatage de la date en utilisant la méthode format()
    //     $dateString = $date->format('Y-m-d');

    //     // Passer la date formatée à plusieurs vues
    //     $contexte = [
    //         'dateString' => $dateString,
    //     ];

    //     return $this->render('home/index.html.twig', [
    //         'dateString' => $dateString,
    //     ])->add($this->render('actualite/index.html.twig', [
    //         'dateString' => $dateString,
    //     ]));
    // }
}
