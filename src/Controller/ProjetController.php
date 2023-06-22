<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    #[Route('/projets', name: 'projets', methods: ['GET'])]
    public function index(Request $request, ProjetRepository $projetRepository, PaginatorInterface $paginator): Response
    {
        $query = $projetRepository->findAllWithCategories();
        $projets = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        return $this->render('projet/projets.html.twig', [
            'projets' => $projets,
        ]);
    }
}
