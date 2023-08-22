<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, ManagerRegistry $doctrine, MailerInterface $mailerInterface): Response
    {
        $contact=new Contact;
        $formcontact= $this->createForm(ContactType::class,$contact);
        $formcontact->handleRequest($request);
        if ($formcontact->isSubmitted() && $formcontact->isValid()) {

            $entityManager = $doctrine->getManager();

            $entityManager->persist($contact);
            $entityManager->flush();

            #Etape : Envoie l'émail
            $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('contact@monsite.com')
            ->subject("Demande de contact")
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                "contact" => $contact
            ]);
            
            $mailerInterface->send($email);

            $this->addFlash('contact_succes',"Le mail a bien été envoyé! On revient sur la page Index");

        }
        
        return $this->render('contact/index.html.twig', [
            'formcontact' => $formcontact->createView(),
        ]);
    }
}