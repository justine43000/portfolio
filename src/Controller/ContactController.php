<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use \Mailjet\Resources;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'contact', methods: ['GET', 'POST'])]

    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();

            $nom = $contact->getNom();
            $prenom = $contact->getPrenom();
            $addresse = $contact->getEmail();
            $telephone = $contact->getTelephone();
            $motif = $contact->getMotif();
            $message = $contact->getMessage();

            require '../vendor/autoload.php';
            $mj = new \Mailjet\Client('97e2933af5c3ccdc5716ed3cf060f387', '0427199dc382b9a91659830425b2842f', true, ['version' => 'v3.1']);

            $body = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' =>  "messagerie@justine-prevot.fr",
                            'Name' => $nom
                        ],
                        'To' => [
                            [
                                'Email' =>  "messagerie@justine-prevot.fr",
                                'Name' => "Justine"
                            ]
                        ],
                        'Subject' => $motif,
                        'HTMLPart' => $message, $prenom, $telephone, $addresse,
                        'CustomID' => "AppGettingStartedTest"
                    ]
                ]
            ];

            $response = $mj->post(Resources::$Email, ['body' => $body]);
            $response->success() && var_dump($response->getData());
            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('home');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
