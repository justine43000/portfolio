<?php

namespace App\Controller\Admin;

use App\Entity\Temoignage;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TemoignageCrudController extends AbstractCrudController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return Temoignage::class;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => 'preList',
        ];
    }

    public function preList(ViewEvent $event): void
    {
        $controllerResult = $event->getControllerResult();
        $request = $event->getRequest();

        if ($controllerResult instanceof Temoignage && $request->getMethod() === 'POST') {
            // Vérifier si l'utilisateur a déjà un témoignage
            $currentUser = $this->getUser();
            $existingTemoignage = $this->entityManager->getRepository(Temoignage::class)->findOneBy(['user' => $currentUser]);

            if ($existingTemoignage !== null) {
                // Si l'utilisateur a déjà un témoignage, redirigez-le vers la page de mise à jour
                $updateUrl = $this->generateUrl('admin_crud.edit', ['entity' => 'Temoignage', 'id' => $existingTemoignage->getId()]);

                $event->setResponse(new RedirectResponse($updateUrl));
            }
        }
    }
}
